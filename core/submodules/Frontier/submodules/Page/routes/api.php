<?php

/**
 * -----------------------------------------------------------------------------
 * API Route
 * -----------------------------------------------------------------------------
 *
 * Handles API routes.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('pages/all', 'PageController@getAll')->name('pages.all');
    Route::get('pages/find', 'PageController@postFind')->name('pages.find');
    Route::get('pages/search', 'PageController@postFind')->name('pages.search');
    Route::get('pages/{page}', 'PageController@getShow')->name('pages.show');
    Route::post('pages/save', 'PageController@postStore')->name('pages.save');
    Route::post('pages/store', 'PageController@postStore')->name('pages.store');
    Route::delete('pages/{page}/destroy', 'PageController@deleteDestroy')->name('pages.destroy');
});

// v2
// ...
