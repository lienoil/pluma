<?php

/**
 * Login/logout route.
 *
 */
Route::get('login', 'User\Controllers\LoginController@showLoginForm')->name('login.show');
Route::post('login', 'User\Controllers\LoginController@login')->name('login.login');

Route::get('registered', 'User\Controllers\RegisterController@showRegisteredPage')->name('register.registered');
Route::get('register', 'User\Controllers\RegisterController@showRegistrationForm')->name('register.show');
// Route::get('register/verify/{token}', 'User\Controllers\VerifyRegistrationController@showVerifiedPage')->name('register.verify');
Route::post('register', 'User\Controllers\RegisterController@register')->name('register.register');

Route::get('logout', 'User\Controllers\LoginController@logout')->name('logout.logout');
Route::post('logout', 'User\Controllers\LoginController@logout')->name('logout.postLogout');

/**
 * User
 *
 */
Route::delete('users/delete/many', 'User\Controllers\UserManyController@delete')->name('users.many.delete');
Route::delete('users/delete/{user}', 'User\Controllers\UserController@delete')->name('users.delete');
Route::delete('users/destroy/many', 'User\Controllers\UserManyController@destroy')->name('users.many.destroy');
Route::get('users/refresh', 'User\Controllers\UserRefreshController@index')->name('users.refresh.index');
Route::get('users/trash', 'User\Controllers\UserController@trash')->name('users.trash');
Route::post('users/refresh', 'User\Controllers\UserRefreshController@refresh')->name('users.refresh.refresh');
Route::post('users/restore/many', 'User\Controllers\UserManyController@restore')->name('users.many.restore');
Route::post('users/{user}/restore', 'User\Controllers\UserController@restore')->name('users.restore');
Route::resource('users', 'User\Controllers\UserController');
