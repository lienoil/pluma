<?php

Route::get(config('path.dashboard', 'dashboard'), 'DashboardController@dashboard')->name('dashboard');
