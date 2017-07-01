<?php

Route::get('/', function () {
    return redirect()->route('login.show');
});

/**
 * Login/logout route.
 *
 */
Route::get('login', 'User\Controllers\LoginController@showLoginForm')->name('login.show');
Route::post('login', 'User\Controllers\LoginController@login')->name('login.login');

Route::get('logout', 'User\Controllers\LoginController@logout')->name('logout.logout');
Route::post('logout', 'User\Controllers\LoginController@logout')->name('logout.logout');
