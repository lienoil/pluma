<?php

Route::get(config('path.dashboard', 'dashboard'), 'DashboardController@index')->name('dashboard');
