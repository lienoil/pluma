<?php

/**
 * -----------------------------------------------------------------------------
 * API Page Route
 * -----------------------------------------------------------------------------
 *
 * Handles the public facing routes, e.g. Home, About Us, etc.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('pages/all', 'PageController@getAll')->name('pages.all');

    Route::get('pages/find', 'PageController@postFind')->name('pages.find');
    Route::get('pages/search', 'PageController@postFind')->name('pages.search');

    Route::get('pages/{page}', 'PageController@getShow')->name('pages.show');
});
