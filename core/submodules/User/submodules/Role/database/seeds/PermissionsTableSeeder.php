<?php

use Phinx\Seed\AbstractSeed;
use Role\Models\Permission;

class PermissionsTableSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        try {
            // Get The enabled Modules
            $modules = get_modules_path();
            // Get the enabled modules' permissions file
            $permissions = $this->permissions($modules);
            // transform into a collection
            $permissions = collect($permissions);
            $p = clone $permissions;
            // get the Permissions by code, as a collection
            $old = collect(Permission::get()->toArray())->keyBy('code');
            // get all old Permissions that are no longer existing in the new
            $removables = array_diff(array_keys($old->all()), array_keys($p->all()));
            // delete the removables.
            foreach ($removables as $code) {
                $permission = Permission::whereCode($code)->first();

                if (! is_null($permission)) {
                    $permission->delete();
                }
            }
            // Create new permissions if it does not exist yet.
            foreach ($permissions as $code => $permission) {
                $permission = Permission::updateOrCreate(['code' => $permission['code']], $permission);
            }
        } catch (Exception $e) {
            //
        }
    }

    /**
     * Gets the permissions.
     *
     * @param  array $modules
     * @return void
     */
    public function permissions($modules = null)
    {
        $modules = is_null($modules) ? get_modules_path() : $modules;

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
}
