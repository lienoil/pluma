<?php

use Course\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $title = str_replace('.', '', ucwords($faker->unique()->realText(mt_rand(10, 40), 4))),
        'slug' => $slug = str_slug($title.microtime(true)),
        'code' => $faker->unique()->swiftBicNumber.microtime(true),
        'feature' => $faker->imageUrl(300, 300),
        'backdrop' => $faker->imageUrl(1000, 600),
        'body' => $faker->paragraph,
    ];
});
