<?php

/**
 * -----------------------------------------------------------------------------
 * API Routes
 * -----------------------------------------------------------------------------
 *
 * Handles the API routes.
 *
 */

Route::group(['prefix' => 'v1'], function () {
    Route::get('forums/all', 'ForumController@getAll')->name('forums.all');

    Route::get('forums/find', 'ForumController@postFind')->name('forums.find');
    Route::get('forums/search', 'ForumController@postFind')->name('forums.search');

    Route::get('forums/{forum}', 'ForumController@getShow')->name('forums.show');

    Route::delete('forums/{forum}', 'ForumController@deleteDestroy')->name('forums.destroy');
});
