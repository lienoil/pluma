<?php

Route::post('auth/login', 'User\API\Controllers\LoginController@login')->name('auth.login');

Route::delete('users/destroy/{user}', 'User\API\Controllers\UserController@destroy')->name('users.destroy');
Route::delete('users/delete/{user}', 'User\API\Controllers\UserController@delete')->name('users.delete');
Route::get('users/all', 'User\API\Controllers\UserController@all')->name('users.all');
Route::get('users/search', 'User\API\Controllers\UserController@search')->name('users.search');
Route::get('users/trash/all', 'User\API\Controllers\UserController@getTrash')->name('users.trash.all');
Route::post('users/grants', 'User\API\Controllers\UserController@grants')->name('users.grants');
Route::post('users/{user}/restore', 'User\API\Controllers\UserController@restore')->name('users.restore');
