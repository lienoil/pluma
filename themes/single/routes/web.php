<?php

use Pluma\Support\Facades\Route;

Route::any('s/{slug?}', function () {
    return view("Theme::layouts.public");
})->where('slug', '.*');

Route::any('s/admin/{slug?}', function () {
    return view("Theme::layouts.admin");
})->where('slug', '.*');
