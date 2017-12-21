<?php

/**
 * Login/logout route.
 *
 */
Route::get('login', 'LoginController@showLoginForm')->name('login.show');
Route::post('login', 'LoginController@login')->name('login.login');

Route::get('registered', 'RegisterController@showRegisteredPage')->name('register.registered');
Route::get('register', 'RegisterController@showRegistrationForm')->name('register.show');
// Route::get('register/verify/{token}', 'VerifyRegistrationController@showVerifiedPage')->name('register.verify');
Route::post('register', 'RegisterController@register')->name('register.register');

Route::get('logout', 'LoginController@logout')->name('logout.logout');
Route::post('logout', 'LoginController@logout')->name('logout.postLogout');
