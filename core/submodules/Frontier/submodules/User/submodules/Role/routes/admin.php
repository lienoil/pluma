<?php

Route::group(['prefix' => 'users'], function () {
    Route::resource('roles', 'Role\Controllers\RoleController');

    Route::resource('grants', 'Role\Controllers\GrantController');

    Route::get('permissions/refresh', 'Role\Controllers\PermissionRefreshController@index')->name('permissions.refresh');
    Route::resource('permissions', 'Role\Controllers\PermissionController');
});
