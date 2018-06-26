<?php

use Course\Models\Course;
use Course\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) use ($factory) {
    return [
        'title' => $title = str_replace('.', '', ucwords($faker->unique()->realText(40, 4))),
        'slug' => $slug = str_slug($title),
        'sort' => 0,
        'code' => $faker->swiftBicNumber,
        'feature' => $faker->imageUrl(300, 300),
        'body' => $faker->paragraph,
        'course_id' => factory(Course::class)->create()->id,
    ];
});
