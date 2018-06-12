<?php

use Faker\Factory;
use Pluma\Support\Database\Seeder;
use Timesheet\Models\Timesheet;

class TimesheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $date = $faker->date();
        $timesheet = new Timesheet();
        $timesheet->day = date('N', strtotime($date));
        $timesheet->date = $date;
        $timesheet->week = (int) date('W', strtotime($date));
        $timesheet->timein = date('Y-m-d H:i:s', strtotime($date));
        $timesheet->timeout = date('Y-m-d H:i:s', strtotime($date));
        $timesheet->save();
    }
}
