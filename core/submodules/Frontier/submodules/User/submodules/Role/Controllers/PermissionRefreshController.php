<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Role\Models\Permission;

class PermissionRefreshController extends Controller
{
    public function index(Request $request)
    {
        $resources = Permission::paginate();

        return view("Role::permissions-refresh.index")->with(compact('resources'));
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
            $permissions = [];
            // Get The enabled Modules
            $modules = modules(true, null, false);
            // Get the enabled modules' permissions file
            // $this->permissions += $this->
            $permissions = $this->permissions($modules);
            // transform into a collection
            $permissions = collect($permissions);
            $p = $permissions;
            // get the Permissions by code, as a collection
            $old = collect(Permission::get()->toArray())->keyBy('code');
            // get all old Permissions that are no longer existing in the new
            $removables = array_diff(array_keys($old->all()), array_keys($p->all()));
            // delete the removables.
            foreach ($removables as $code) {
                $permission = Permission::whereSlug($code)->first();

                if (! is_null($permission)) {
                    $permission->delete();
                }
            }
            // Create new permissions if it does not exist yet.
            foreach ($permissions as $code => $permission) {
                if (! Permission::whereCode($permission['code'])->exists()) {
                    $permission = new Permission();//Permission::create( $permission );
                    $permission->name = $permission['name'];
                    $permission->code = $permission['code'];
                    $permission->description = $permission['description'];
                    $permission->save();
                }
            }
        } catch (Exception $e) {
            session()->flash('type', 'success');
            session()->flash('message', $e->getMessage());
        } finally {
            // Disco.
            session()->flash('type', 'success');
            session()->flash('message', 'Resource successfully refreshed');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reset()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        \DB::table('permission_role')->truncate();
        Permission::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        \Artisan::call('db:seed', ['--class' => '\Pluma\Database\Seeds\PermissionsTableSeeder']);

        session()->flash('type', 'success');
        session()->flash('message', 'Resource successfully refreshed.');

        return redirect()->route('permissions.index');
    }

    /**
     * Display the Refresh resource
     *
     * @return \Illuminate\Http\Response
     */
    public function showRefreshMessage()
    {
        return view("Pluma::permissions.refresh");
    }

    /**
     * Display the Reset resource
     *
     * @return Illuminate\Http\Response
     */
    public function showResetMessage()
    {
        return view("Pluma::permissions.reset");
    }
}
