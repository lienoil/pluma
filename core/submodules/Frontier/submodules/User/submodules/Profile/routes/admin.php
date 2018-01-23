<?php

/**
 *------------------------------------------------------------------------------
 * Admin Profile Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes for profile.
 *
 */

// Credentials
Route::get('profile/{handle}/credentials', 'CredentialController@index')->name('credentials.index');

Route::get('profile', function () {
    return redirect()->route('profile.show', user()->handlename);
})->name('profile.index');

Route::get('profile/{handle}', 'ProfileController@show')->name('profile.show');
Route::get('profile/{handle}/edit', 'ProfileController@edit')->name('profile.edit');
Route::put('profile/{handle}', 'ProfileController@update')->name('profile.update');

