<?php

use Phinx\Seed\AbstractSeed;
use Role\Models\Grant;
use Role\Models\Permission;

class GrantsTableSeeder extends AbstractSeed
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
                $grant->name = "Full " . ucfirst(str_plural($name));
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
        } catch (\Exception $e) {
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
