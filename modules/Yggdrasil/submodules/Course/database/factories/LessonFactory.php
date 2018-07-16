<?php

use Course\Models\Course;
use Course\Models\Lesson;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    static $i = 0;

    return [
        'title' => $title = str_replace('.', '', ucwords($faker->unique()->realText(mt_rand(10, 90), 4))),
        'slug' => str_slug($title.microtime(true)),
        'sort' => $i++,
        'code' => $faker->unique()->swiftBicNumber.microtime(true),
        'feature' => $faker->imageUrl(300, 300),
        'body' => $faker->paragraph,
    ];
});
