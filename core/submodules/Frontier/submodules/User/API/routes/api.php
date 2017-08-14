<?php

Route::post('auth/login', 'User\API\Controllers\LoginController@login')->name('auth.login');

Route::get('users/all', 'User\API\Controllers\UserController@all')->name('users.all');
Route::get('users/search', 'User\API\Controllers\UserController@search')->name('users.search');
