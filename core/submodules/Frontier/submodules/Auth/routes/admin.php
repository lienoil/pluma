<?php

Route::get('/', function () {
    return redirect()->route('admin.login');
});

Route::get('login', 'Admin\Auth\Controllers\LoginController@getLoginForm')->name('admin.login');
