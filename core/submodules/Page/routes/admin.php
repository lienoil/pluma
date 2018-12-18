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
// Route::resource('pages/categories', 'CategoryController', [
//         'except' => ['show', 'create'],
//         'as' => 'pages',
//     ]);

Route::middleware(['breadcrumbs:\Page\Models\Page'])->group(function () {
    # Owned resource
    Route::get('pages/owned', 'PageController@owned')->name('pages.owned');

    # SoftDelete routes
    Route::softDeletes('pages', 'PageController');

    # Main resource
    Route::resource('pages', 'PageController');
});
