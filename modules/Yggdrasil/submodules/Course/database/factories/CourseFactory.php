<?php

use Course\Models\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'code' => $faker->code,
    ];
});
