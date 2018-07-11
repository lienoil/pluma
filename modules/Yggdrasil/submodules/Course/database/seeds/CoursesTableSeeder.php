<?php

use Course\Models\Course;
use Course\Models\Lesson;
use Faker\Factory as Faker;
use Pluma\Support\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = factory(Course::class, 10)->create();

        collect($courses)->each(function ($course) {
            $lessons = factory(Lesson::class, 10)->create([
                'course_id' => $course->id,
            ]);

            collect($lessons)->each(function ($lesson) use ($course) {
                $lesson->adjaceables()->addAsRoot();

                $chapters = factory(Lesson::class, 10)->create();

                collect($chapters)->each(function ($chapter) use ($lesson) {
                    $lesson->adjaceables()->attach($chapter);
                });
            });
        });
    }
}
