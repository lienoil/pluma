<?php

use Course\Models\Course;
use Course\Models\Lesson;
use Faker\Factory as Faker;
use Pluma\Support\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $courses = Course::all();
        foreach ($courses as $course) {
            for ($i = 0; $i < 10; $i++) {
                $lesson = new Lesson();
                $lesson->title = $title = str_replace('.', '', ucwords($faker->realText(40, 4)));
                $lesson->slug = $slug = str_slug($title);
                $lesson->code = $code = $faker->swiftBicNumber;
                $lesson->feature = $faker->imageUrl(300, 300);
                $lesson->body = $body = $faker->paragraph;
                $lesson->course()->associate(Course::find($course->id));
                $lesson->save();
            }
        }
    }
}
