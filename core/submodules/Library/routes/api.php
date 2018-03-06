<?php

use Catalogue\Models\Catalogue;

Route::group(['prefix' => 'v1'], function () {
    # Catalogues
    Route::post('library/catalogues', function () {
        return response()->json(Catalogue::mediabox());
    })->name('library.catalogues');

    Route::get('library/catalogue/{catalogue}', 'LibraryController@fromCatalogue')->name('library.catalogue');

    # API normal routes
    Route::get('library/all', 'LibraryController@getAll')->name('library.all');
});
