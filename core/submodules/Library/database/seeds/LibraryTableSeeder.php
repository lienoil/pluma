<?php

use Library\Models\Library;
use Pluma\Support\Database\Seeder;

class LibraryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Library::class, 10)->create();
    }
}
