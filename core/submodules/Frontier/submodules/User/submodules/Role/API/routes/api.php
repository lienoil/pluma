<?php

Route::get('roles/trash/all', 'Role\API\Controllers\RoleController@getTrash')->name('roles.trash.all');
Route::get('roles/all', 'Role\API\Controllers\RoleController@all')->name('roles.all');
Route::get('roles/search', 'Role\API\Controllers\RoleController@search')->name('roles.search');
Route::post('roles/grants', 'Role\API\Controllers\RoleController@grants')->name('roles.grants');

Route::get('grants/trash/all', 'Role\API\Controllers\GrantController@all')->name('grants.trash.all');
Route::get('grants/all', 'Role\API\Controllers\GrantController@all')->name('grants.all');
Route::get('grants/search', 'Role\API\Controllers\GrantController@search')->name('grants.search');
Route::post('grants/permissions', 'Role\API\Controllers\GrantController@permissions')->name('grants.permissions');

Route::get('permissions/all', 'Role\API\Controllers\PermissionController@all')->name('permissions.all');
Route::get('permissions/search', 'Role\API\Controllers\PermissionController@search')->name('permissions.search');
