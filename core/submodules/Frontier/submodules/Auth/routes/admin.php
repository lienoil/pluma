<?php

Route::get('/', function () {
    return redirect()->route('login.show');
});

/**
 * Login/logout route.
 *
 */
Route::get('login', 'Auth\Controllers\LoginController@showLoginForm')->name('login.show');
Route::post('login', 'Auth\Controllers\LoginController@login')->name('login.login');

Route::get('logout', 'Auth\Controllers\LoginController@logout')->name('logout.logout');
Route::post('logout', 'Auth\Controllers\LoginController@logout')->name('logout.logout');
