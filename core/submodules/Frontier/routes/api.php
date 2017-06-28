<?php

// Route::get('{slug?}', );
Route::get('pages', '\Frontier\API\Controllers\PublicController@show')->name('pages.show');
// App::missing(function ($exceptions) {
//     return View::make('index');
// });