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

Route::get('users', 'Dashboard\Controllers\DashboardController@index')->name('users.index');
Route::get('users/create', 'Dashboard\Controllers\DashboardController@index')->name('users.index');
