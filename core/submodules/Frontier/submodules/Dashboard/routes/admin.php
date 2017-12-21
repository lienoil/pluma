<?php

Route::get(settings('path.admin', 'admin'), function () {
    return redirect()->route('dashboard');
});

Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
