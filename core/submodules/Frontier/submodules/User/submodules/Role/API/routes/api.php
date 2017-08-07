<?php

Route::post('permissions/refresh', 'Role\API\Controllers\PermissionRefreshController@postRefresh')->name('permissions.refresh');

Route::get('permissions/all', 'Role\API\Controllers\PermissionController@getAll')->name('permissions.all');
Route::get('permissions/search', 'Role\API\Controllers\PermissionController@search')->name('permissions.search');

Route::get('grants/all', 'Role\API\Controllers\GrantController@getAll')->name('grants.all');
Route::post('grants/store', 'Role\API\Controllers\GrantController@store')->name('grants.store');
Route::post('grants/find', 'Role\API\Controllers\GrantController@find')->name('grants.find');
Route::put('grants/update', 'Role\API\Controllers\GrantController@update')->name('grants.update');
Route::delete('grants/remove/{id}', 'Role\API\Controllers\GrantController@remove')->name('grants.remove');
