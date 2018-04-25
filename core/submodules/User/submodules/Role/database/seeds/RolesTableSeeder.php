<?php

use Phinx\Seed\AbstractSeed;
use Role\Models\Role;

class RolesTableSeeder extends AbstractSeed
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
            $role = new Role();
            $role->name = $set['name'];
            $role->alias = $set['alias'];
            $role->code = $set['code'];
            $role->description = $set['description'];
            $role->save();
        }
    }
}
