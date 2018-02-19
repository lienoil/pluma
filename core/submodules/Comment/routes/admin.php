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
Route::get('settings/commenting', 'CommentingSettingController@index')->name('settings.commenting');
Route::post('settings/commenting', 'CommentingSettingController@store')->name('settings.commenting.store');

// Route::get('comments/trash', '\Comment\Controllers\CommentController@trash')->name('comments.trash');
Route::get('comments/trashed', 'CommentController@trashed')
     ->name('comments.trashed');

Route::patch('comments/restore/{comment}', 'CommentController@restore')
     ->name('comments.restore');

Route::delete('comments/delete/{comment}', 'CommentController@delete')
     ->name('comments.delete');

// Comments
Route::resource('comments', 'CommentController');
