<?php
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', 'Dashboard\Controllers\DashboardController@index')->name('dashboard');
Route::get('pages', 'Dashboard\Controllers\DashboardController@index')->name('page');
Route::get('pages/create', 'Dashboard\Controllers\DashboardController@index')->name('cre');
