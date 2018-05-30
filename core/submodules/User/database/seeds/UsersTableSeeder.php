<?php

use Pluma\Support\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use User\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'firstname' => 'Pluma',
                'lastname' => 'CMS',
                'username' => 'superadmin',
                'password' => Hash::make('superadmin'),
                'email' => 'dummy@pluma.io',
            ],
        ];

        foreach ($users as $fake) {
            User::updateOrCreate(['username' => $fake['username']], $fake);
        }
    }
}
