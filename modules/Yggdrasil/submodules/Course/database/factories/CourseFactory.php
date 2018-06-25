<?php

use Course\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $title = str_replace('.', '', ucwords($faker->realText(40, 4))),
        'slug' => $slug = str_slug($title),
        'code' => $faker->swiftBicNumber,
        'feature' => $faker->imageUrl(300, 300),
        'backdrop' => $faker->imageUrl(1000, 600),
        'body' => $faker->paragraph,
    ];
});
