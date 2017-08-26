<?php

/**
 * Password
 *
 */

/**
 * User
 *
 */
Route::get('users/{id}/password/change', 'User\Controllers\PasswordController@getChangeForm')->name('password.change.form');
Route::post('users/password/change/{id}', 'User\Controllers\PasswordController@change')->name('password.change');
Route::delete('users/delete/many', 'User\Controllers\UserManyController@delete')->name('users.many.delete');
Route::delete('users/delete/{user}', 'User\Controllers\UserController@delete')->name('users.delete');
Route::delete('users/destroy/many', 'User\Controllers\UserManyController@destroy')->name('users.many.destroy');
Route::get('users/refresh', 'User\Controllers\UserRefreshController@index')->name('users.refresh.index');
Route::get('users/trash', 'User\Controllers\UserController@trash')->name('users.trash');
Route::post('users/refresh', 'User\Controllers\UserRefreshController@refresh')->name('users.refresh.refresh');
Route::post('users/restore/many', 'User\Controllers\UserManyController@restore')->name('users.many.restore');
Route::post('users/{user}/restore', 'User\Controllers\UserController@restore')->name('users.restore');
Route::resource('users', 'User\Controllers\UserController');
