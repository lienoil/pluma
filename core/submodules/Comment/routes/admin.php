<?php

/**
 *------------------------------------------------------------------------------
 * Admin Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// Settings
Route::get('settings/commenting', 'CommentingSettingController@index')->name('settings:commenting.index');
Route::post('settings/commenting', 'CommentingSettingController@store')->name('settings:commenting.index.store');

// Soft Deletes
Route::softDeletes('comments', 'CommentController');

// Comments
Route::resource('comments', 'CommentController');
