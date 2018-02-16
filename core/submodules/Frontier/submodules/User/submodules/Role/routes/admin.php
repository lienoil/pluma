<?php

Route::group(['prefix' => 'users'], function () {
    /**
     * Roles
     *
     */
    Route::delete('roles/delete/many', 'RoleManyController@delete')->name('roles.many.delete');
    Route::delete('roles/delete/{role}', 'RoleController@delete')->name('roles.delete');
    Route::delete('roles/destroy/many', 'RoleManyController@destroy')->name('roles.many.destroy');
    Route::get('roles/refresh', 'RoleRefreshController@index')->name('roles.refresh.index');
    Route::get('roles/trashed', 'RoleController@trashed')->name('roles.trashed');
    Route::post('roles/refresh', 'RoleRefreshController@refresh')->name('roles.refresh.refresh');
    Route::post('roles/restore/many', 'RoleManyController@restore')->name('roles.many.restore');
    Route::post('roles/{role}/restore', 'RoleController@restore')->name('roles.restore');
    Route::resource('roles', 'RoleController');

    /**
     * Grants
     *
     */
    Route::delete('grants/delete/many', 'GrantManyController@delete')->name('grants.many.delete');
    Route::delete('grants/delete/{grant}', 'GrantController@delete')->name('grants.delete');
    Route::delete('grants/destroy/many', 'GrantManyController@destroy')->name('grants.many.destroy');
    Route::get('grants/refresh', 'GrantRefreshController@index')->name('grants.refresh.index');
    Route::get('grants/trashed', 'GrantController@trashed')->name('grants.trashed');
    Route::post('grants/refresh', 'GrantRefreshController@refresh')->name('grants.refresh.refresh');
    Route::post('grants/restore/many', 'GrantManyController@restore')->name('grants.many.restore');
    Route::post('grants/{grant}/restore', 'GrantController@restore')->name('grants.restore');
    Route::resource('grants', 'GrantController');

    /**
     * Permissions
     *
     */
    Route::get('permissions/refresh', 'PermissionRefreshController@index')->name('permissions.refresh.index');
    Route::post('permissions/refresh', 'PermissionRefreshController@refresh')->name('permissions.refresh.refresh');
    Route::post('permissions/reset', 'PermissionRefreshController@reset')->name('permissions.reset.reset');
    // Route::resource('permissions', 'PermissionController');
    Route::get('permissions', 'PermissionController@index')->name('permissions.index');
});
