<?php

use Course\Models\Course;
use Course\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) use ($factory) {
    return [
        'title' => $title = str_replace('.', '', ucwords($faker->unique()->realText(mt_rand(10, 90), 4))),
        'slug' => str_slug($title.microtime(true)),
        'sort' => 0,
        'code' => $faker->unique()->swiftBicNumber.microtime(true),
        'feature' => $faker->imageUrl(300, 300),
        'body' => $faker->paragraph,
        // 'course_id' => factory(Course::class)->create()->id,
    ];
});
