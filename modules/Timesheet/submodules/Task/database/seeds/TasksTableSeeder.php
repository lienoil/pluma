<?php

use Pluma\Support\Database\Seeder;
use Task\Models\Task;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $task = new Task();
            $task->name = $faker->company;
            $task->body = $faker->realText();
            $task->hours = $faker->unixTime();
            $task->save();
        }
    }
}
