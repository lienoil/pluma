<?php

Route::get(config('path.dashboard', 'dashboard'), [
    'uses' => 'DashboardController@index',
    'component' => 'components/Dashboard/Dashboard.vue'
])->name('dashboard');
