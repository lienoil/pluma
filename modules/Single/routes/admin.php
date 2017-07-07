<?php

// Route::get('dashboard', 'Dashboard\Controllers\DashboardController@index')->name('dashboard');
Route::get('/_', 'Single\Controllers\AdminController@getRootPage')->where('slug', '.*');
