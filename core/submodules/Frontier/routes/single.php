<?php

Route::any(config('routes.admin.slug', 'admin').'/{catchall?}', function ($catchall = null) {
    return view("User::auth.login.login");
})->where('catchall', '.*');

Route::any('{catchall?}', function ($catchall = null) {
    return view("Frontier::layouts.master");
})->where('catchall', '.*');
