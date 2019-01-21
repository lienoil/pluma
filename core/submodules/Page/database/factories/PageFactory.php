<?php

use Faker\Generator as Faker;
use Page\Models\Page;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'code' => $faker->unique()->randomDigit,
        'feature' => $faker->imageUrl,
        'body' => $faker->paragraph,
        'delta' => $faker->paragraph,
        'user_id' => function () {
            return factory(\User\Models\User::class)->create()->id;
        },
    ];
});
