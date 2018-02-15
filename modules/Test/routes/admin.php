<?php

// Tests
// Route::any('{slug?}', function () {
//     return view("Test::index");
// })->where('slug', '.*');

Route::get('tests/trashed', 'TestController@trashed')->name('tests.trashed');
Route::resource('tests', 'TestController');
