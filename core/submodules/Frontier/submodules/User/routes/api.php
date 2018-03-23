<?php

/**
 *------------------------------------------------------------------------------
 * User API Routes
 *------------------------------------------------------------------------------
 *
 * The API routes for users.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('users/all', 'UserController@getAll')->name('users.all');
    Route::get('users/find', 'UserController@postFind')->name('users.find');
    Route::get('users/search', 'UserController@postFind')->name('users.search');
    Route::get('users/{user}', 'UserController@getShow')->name('users.show');
});
