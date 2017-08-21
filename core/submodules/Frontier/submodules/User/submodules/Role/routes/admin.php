<?php

Route::group(['prefix' => 'users'], function () {
    /**
     * Roles
     *
     */
    Route::delete('roles/delete/many', 'Role\Controllers\RoleManyController@delete')->name('roles.many.delete');
    Route::delete('roles/delete/{role}', 'Role\Controllers\RoleController@delete')->name('roles.delete');
    Route::delete('roles/destroy/many', 'Role\Controllers\RoleManyController@destroy')->name('roles.many.destroy');
    Route::get('roles/refresh', 'Role\Controllers\RoleRefreshController@index')->name('roles.refresh.index');
    Route::get('roles/trash', 'Role\Controllers\RoleController@trash')->name('roles.trash');
    Route::post('roles/refresh', 'Role\Controllers\RoleRefreshController@refresh')->name('roles.refresh.refresh');
    Route::post('roles/restore/many', 'Role\Controllers\RoleManyController@restore')->name('roles.many.restore');
    Route::post('roles/{role}/restore', 'Role\Controllers\RoleController@restore')->name('roles.restore');
    Route::resource('roles', 'Role\Controllers\RoleController');

    /**
     * Grants
     *
     */
    Route::delete('grants/delete/many', 'Role\Controllers\GrantManyController@delete')->name('grants.many.delete');
    Route::delete('grants/delete/{grant}', 'Role\Controllers\GrantController@delete')->name('grants.delete');
    Route::delete('grants/destroy/many', 'Role\Controllers\GrantManyController@destroy')->name('grants.many.destroy');
    Route::get('grants/refresh', 'Role\Controllers\GrantRefreshController@index')->name('grants.refresh.index');
    Route::get('grants/trash', 'Role\Controllers\GrantController@trash')->name('grants.trash');
    Route::post('grants/refresh', 'Role\Controllers\GrantRefreshController@refresh')->name('grants.refresh.refresh');
    Route::post('grants/restore/many', 'Role\Controllers\GrantManyController@restore')->name('grants.many.restore');
    Route::post('grants/{grant}/restore', 'Role\Controllers\GrantController@restore')->name('grants.restore');
    Route::resource('grants', 'Role\Controllers\GrantController');

    /**
     * Permissions
     *
     */
    Route::get('permissions/refresh', 'Role\Controllers\PermissionRefreshController@index')->name('permissions.refresh.index');
    Route::post('permissions/refresh', 'Role\Controllers\PermissionRefreshController@refresh')->name('permissions.refresh.refresh');
    Route::post('permissions/reset', 'Role\Controllers\PermissionRefreshController@reset')->name('permissions.reset.reset');
    // Route::resource('permissions', 'Role\Controllers\PermissionController');
    Route::get('permissions', 'Role\Controllers\PermissionController@index')->name('permissions.index');
});
