<?php

use Role\Models\Role;
use Pluma\Support\Database\Seeder;

class RolesTableSeeder extends Seeder
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
        $dataset = array(
            array(
                'name' => 'Super Administrator',
                'alias' => 'Superadmin',
                'code' => 'superadmin',
                'description' => 'The highest Role available for users.',
            ),
            array(
                'name' => 'Administrator',
                'alias' => 'Admin',
                'code' => 'admin',
                'description' => 'The Official Site admin. Manages creation of other users.',
            ),
        );

        $dataset = array_merge($dataset, config('defaults.roles', []));

        foreach ($dataset as $set) {
            Role::updateOrCreate(['code' => $set['code']], $set);
        }
    }
}
