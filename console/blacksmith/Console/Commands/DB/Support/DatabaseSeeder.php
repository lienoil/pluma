<?php

use Illuminate\Database\Seeder;
use Pluma\Support\Modules\Traits\ModulerTrait;

class DatabaseSeeder extends Seeder
{
    use ModulerTrait;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
    }
}
