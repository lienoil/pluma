<?php

use Pluma\Support\Database\Seeder;
use Faker\Factory as Faker;
use Course\Models\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i = 0; $i < 3; $i++) {
            $course = new Course();
            $course->title = $title = str_replace('.', '', ucwords($faker->realText(40, 4)));
            $course->slug = $slug = str_slug($title);
            $course->code = $code = $faker->swiftBicNumber;
            $course->feature = $faker->imageUrl(300, 300);
            $course->backdrop = $faker->imageUrl(1000, 600);
            $course->body = $body = $faker->paragraph;
            $course->save();
        }
    }
}
