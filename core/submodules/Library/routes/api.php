<?php

use Catalogue\Models\Catalogue;

Route::group(['prefix' => 'v1'], function () {
    # Catalogues
    Route::post('library/catalogues', function () {
        return response()->json(Catalogue::mediabox());
    })->name('library.catalogues');
});
