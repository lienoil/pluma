<?php

/**
 *------------------------------------------------------------------------------
 * Admin Page Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// Category routes
Route::resource('pages/categories', 'CategoryController', [
        'except' => ['show', 'create'],
        'as' => 'pages',
    ]);

// SoftDelete routes
// Route::softDeletes('pages', 'PageController');
// Route::get('pages/trashed', 'PageController@trashed')
//      ->name('pages.trashed');

// Route::patch('pages/restore/{page}', 'PageController@restore')
//      ->name('pages.restore');

// Route::delete('pages/delete/{page}', 'PageController@delete')
//      ->name('pages.delete');

// Admin routes
// Route::resource('pages', 'PageController');
