<?php

Route::get('profile', function () {
    return redirect()->route('profile.show', user()->handlename);
})->name('profile.index');

Route::get('profile/{handle?}', 'ProfileController@show')->name('profile.show');
// Route::resource('profile', 'Profile\Controllers\ProfileController');
