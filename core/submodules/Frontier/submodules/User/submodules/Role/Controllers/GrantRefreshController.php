<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Role\Models\Grant;
use Role\Models\Permission;

class GrantRefreshController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Grant::paginate();

        return view("Role::grants-refresh.index")->with(compact('resources'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refresh(Request $request)
    {
        try {
            $grants = [];
            $permissions = $this->permissions();

            foreach ($permissions as $permission) {
                if (! isset($permission['group'])) {
                    $permission['group'] = 'others';
                }

                $grants[$permission['group']][] = $permission;
            }

            foreach ($grants as $name => $permissions) {
                $grant = Grant::updateOrCreate(['code' => $name]);
                $grant->name = ucfirst(str_plural($name));
                $grant->code = $name;
                $grant->description = "Collection of $name permissions.";
                $grant->save();

                $p = [];
                foreach ($permissions as $permission) {
                    $permission = Permission::whereCode($permission['code'])->first();

                    if ($permission) {
                        $p[] = $permission->id;
                    }
                }
                $grant->permissions()->sync($p);
            }
        } catch (Exception $e) {
            session()->flash('type', 'error');
            session()->flash('message', $e->getMessage());
        } finally {
            // Disco.
            session()->flash('type', 'success');
            session()->flash('message', 'Grants list successfully updated');
        }

        return back();
    }

    /**
     * Gets the permissions.
     *
     * @param  array $modules
     * @return void
     */
    public function permissions($modules = null)
    {
        $modules = is_null($modules) ? modules(true, null, false) : $modules;

        $permissions = [];
        foreach ($modules as $name => $module) {
            if (is_array($module)) {
                $permissions = $this->permissions($module);

                $module = $name;
            }

            if (file_exists("$module/config/permissions.php")) {
                $permissions += require "$module/config/permissions.php";
            }
        }

        return $permissions;
    }

    /**
     * Display the Refresh resource
     *
     * @return \Illuminate\Http\Response
     */
    public function showRefreshMessage()
    {
        return view("Pluma::grants.refresh");
    }

    /**
     * Display the Reset resource
     *
     * @return Illuminate\Http\Response
     */
    public function showResetMessage()
    {
        return view("Pluma::grants.reset");
    }
}
