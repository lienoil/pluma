<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Role\Models\Permission;

class PermissionRefreshController extends Controller
{
    /**
     * Collected permissions.
     *
     * @var array|mixed
     */
    protected $permissions;

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refresh(Request $request)
    {
        // Get The enabled Modules
        $modules = config("modules.enabled");

        // Get the enabled modules' permissions file
        // $this->permissions += $this->
        foreach ($modules as $module) {
            if (file_exists(base_path("modules/$module/config/permissions.php"))) {
                $permissions += require base_path("modules/$module/config/permissions.php");
            }
        }
        // transform into a collection
        $permissions = collect($permissions);
        $p = $permissions;
        // get the Permissions by slug, as a collection
        $old = collect(Permission::get()->toArray())->keyBy('slug');
        // get all old Permissions that are no longer existing in the new
        $removables = array_diff(array_keys($old->all()), array_keys($p->all()));
        // delete the removables.
        foreach ($removables as $slug) {
            $permission = Permission::whereSlug($slug)->first();

            if (! is_null($permission)) {
                $permission->delete();
            }
        }

        // Create new permissions if it does not exist yet.
        foreach ($permissions as $slug => $permission) {
            if (! Permission::whereSlug($permission['slug'])->exists()) {
                $_permission = new Permission();//Permission::create( $permission );
                $_permission->name = $permission['name'];
                $_permission->slug = $permission['slug'];
                $_permission->description = $permission['description'];
                $_permission->save();
            }
        }

        // Disco.
        session()->flash('type', 'success');
        session()->flash('message', 'Resource successfully refreshed.');

        return redirect()->route('permissions.index');
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
