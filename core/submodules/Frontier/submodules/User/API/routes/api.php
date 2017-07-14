<?php

Route::post('auth/login', 'User\API\Controllers\LoginController@login')->name('auth.login');

// Route::get('register', 'User\Controllers\RegisterController@showRegistrationForm')->name('register.show');
// Route::post('register', 'User\Controllers\RegisterController@register')->name('register.register');

// Route::get('logout', 'User\Controllers\LoginController@logout')->name('logout.logout');
// Route::post('logout', 'User\Controllers\LoginController@logout')->name('logout.postLogout');
