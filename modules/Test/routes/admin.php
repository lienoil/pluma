<?php

// Tests
Route::any('tests/{slug?}', function () {
    return view("Test::index");
})->where('slug', '.*');

Route::resource('tests', 'TestController');
