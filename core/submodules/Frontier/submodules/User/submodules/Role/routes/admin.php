<?php

Route::group(['prefix' => 'users'], function () {
    /**
     * Roles
     *
     */
    Route::resource('roles', 'Role\Controllers\RoleController');

    /**
     * Grants
     *
     */
    Route::get('grants/refresh', 'Role\Controllers\GrantRefreshController@index')->name('grants.refresh.index');
    Route::post('grants/refresh', 'Role\Controllers\GrantRefreshController@refresh')->name('grants.refresh.refresh');
    Route::resource('grants', 'Role\Controllers\GrantController');

    /**
     * Permissions
     *
     */
    Route::get('permissions/refresh', 'Role\Controllers\PermissionRefreshController@index')->name('permissions.refresh.index');
    Route::post('permissions/refresh', 'Role\Controllers\PermissionRefreshController@refresh')->name('permissions.refresh.refresh');
    Route::post('permissions/reset', 'Role\Controllers\PermissionRefreshController@reset')->name('permissions.reset.reset');
    Route::resource('permissions', 'Role\Controllers\PermissionController');
});
