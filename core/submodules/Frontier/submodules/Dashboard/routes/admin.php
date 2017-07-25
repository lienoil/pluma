<?php
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', 'Dashboard\Controllers\DashboardController@index')->name('dashboard');
