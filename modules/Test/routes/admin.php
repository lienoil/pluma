<?php

/**
 *------------------------------------------------------------------------------
 * Admin Test Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// SoftDelete routes
Route::get('tests/trashed', 'TestController@trashed')
     ->name('tests.trashed');

Route::patch('tests/restore/{test}', 'TestController@restore')
     ->name('tests.restore');

Route::delete('tests/delete/{test}', 'TestController@delete')
     ->name('tests.delete');

Route::resource('tests', 'TestController');
