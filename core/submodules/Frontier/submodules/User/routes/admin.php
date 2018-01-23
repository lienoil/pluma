<?php

/**
 *------------------------------------------------------------------------------
 * Admin User Route
 *------------------------------------------------------------------------------
 *
 */
Route::get('users/{id}/password/change', 'PasswordController@getChangeForm')->name('password.change.form');
Route::post('users/password/change/{id}', 'PasswordController@change')->name('password.change');
Route::delete('users/delete/many', 'UserManyController@delete')->name('users.many.delete');
Route::delete('users/delete/{user}', 'UserController@delete')->name('users.delete');
Route::delete('users/destroy/many', 'UserManyController@destroy')->name('users.many.destroy');
Route::get('users/refresh', 'UserRefreshController@index')->name('users.refresh.index');
Route::get('users/trash', 'UserController@trash')->name('users.trash');
Route::post('users/refresh', 'UserRefreshController@refresh')->name('users.refresh.refresh');
Route::post('users/restore/many', 'UserManyController@restore')->name('users.many.restore');
Route::post('users/{user}/restore', 'UserController@restore')->name('users.restore');
Route::resource('users', 'UserController');
