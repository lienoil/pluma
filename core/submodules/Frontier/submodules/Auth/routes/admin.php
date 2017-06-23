<?php

Route::get('/', function () {
    return redirect()->route('login.show');
});

Route::get('login', 'Auth\Controllers\LoginController@showLoginForm')->name('login.show');
Route::post('login', 'Auth\Controllers\LoginController@login')->name('login.login');
