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
        $courses = factory(Course::class, 1)->create();

        $courses->each(function ($course, $i) {
            $lessons = factory(Lesson::class, 5)->create([
                'course_id' => $course->id,
            ]);

            $lessons->each(function ($lesson, $j) use ($course) {
                $lesson->adjaceables()->addAsRoot();

                $chapters = factory(Lesson::class, 5)->create();

                $chapters->each(function ($chapter) use ($lesson) {
                    $lesson->adjaceables()->attach($chapter);
                });
            });
        });
    }
}
