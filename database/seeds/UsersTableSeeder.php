<?php

use Illuminate\Support\Facades\Hash;
use Phinx\Seed\AbstractSeed;

class UsersTableSeeder extends AbstractSeed
{
    public function run()
    {
        $data = array(
            array(
                'email'   => 'john.dionisio1@gmail.com',
                'password' => '$2y$10$WilmJa.thUfYeK1SnvaRJu2CJhxsuKbTRnCsPKb0B5jYuKw2MgvY6',
            ),
        );

        $posts = $this->table('users');
        $posts->insert($data)
            ->save();
    }
}
