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
Route::softDeletes('pages', 'PageController');

// Admin routes
Route::resource('pages', 'PageController');
