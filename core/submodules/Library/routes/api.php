<?php

use Catalogue\Models\Catalogue;

Route::group(['prefix' => 'v1'], function () {
    # Catalogues
    Route::post('library/catalogues', function () {
        return response()->json(Catalogue::catalogued());
    })->name('library.catalogues');

    # API normal routes
    Route::get('library/all', 'LibraryController@getAll')->name('library.all');
});
