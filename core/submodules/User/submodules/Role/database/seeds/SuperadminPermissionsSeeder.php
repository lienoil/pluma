<?php

use Pluma\Support\Database\Seeder;
use Role\Models\Permission;
use Role\Models\Role;

class SuperadminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Role::whereCode('superadmin')->exists()) {
            $superadmin = Role::whereCode('superadmin')->first();
            $superadmin->permissions()->sync(Permission::pluck('id'));
        }
    }
}
