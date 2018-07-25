<?php

use Faker\Generator as Faker;
use Library\Models\Library;

$factory->define(Library::class, function (Faker $faker) {
    return [
        'name' => $name = $faker->word(3, true),
        'originalname' => $faker->word(3, true),
        'filename' => $filename = str_slug($name).".".$faker->fileExtension,
        'pathname' => storage_path("public/{$filename}"),
        'size' => 8000,
        'mimetype' => $faker->mimeType,
        'type' => 'file',
        'description' => $faker->paragraph,
        'thumbnail' => $faker->imageUrl(200, 200),
        'uri' => 'public/'.$filename,
    ];
});
