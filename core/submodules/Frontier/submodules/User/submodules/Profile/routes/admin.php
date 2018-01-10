<?php

/**
 *------------------------------------------------------------------------------
 * Admin Profile Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes for profile.
 *
 */

Route::get('profile', function () {
    return redirect()->route('profile.show', user()->handlename);
})->name('profile.index');

Route::get('profile/{handle}', 'ProfileController@show')->name('profile.show');
Route::get('profile/{handle}/edit', 'ProfileController@edit')->name('profile.edit');
