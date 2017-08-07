<?php

Route::group(['prefix' => 'users'], function () {
    Route::resource('roles', 'Role\Controllers\RoleController');

    Route::resource('grants', 'Role\Controllers\GrantController');

    Route::get('permissions/refresh', 'Role\Controllers\PermissionRefreshController@index')->name('permissions.refresh.index');
    Route::post('permissions/refresh', 'Role\Controllers\PermissionRefreshController@refresh')->name('permissions.refresh.refresh');
    Route::post('permissions/reset', 'Role\Controllers\PermissionRefreshController@reset')->name('permissions.reset');
    Route::resource('permissions', 'Role\Controllers\PermissionController');
});
