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
    Route::get('notes/all', 'NoteController@getAll')->name('notes.all');

    Route::get('notes/find', 'NoteController@postFind')->name('notes.find');
    Route::get('notes/search', 'NoteController@postFind')->name('notes.search');

    Route::get('notes/{note}', 'NoteController@getShow')->name('notes.show');

    Route::delete('notes/{note}', 'NoteController@deleteDestroy')->name('notes.destroy');
});
