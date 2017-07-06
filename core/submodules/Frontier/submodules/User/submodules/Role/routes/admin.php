<?php

Route::resource('roles', 'Role\Controllers\RoleController');

Route::resource('grants', 'Role\Controllers\GrantController');

Route::get('permissions/refresh', 'Role\Controllers\PermissionRefreshController@index');
Route::resource('permissions', 'Role\Controllers\PermissionController');
