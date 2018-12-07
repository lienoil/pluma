<?php

Route::prefix('appearance')->middleware(['breadcrumbs:\Theme\Models\Theme'])->group(function () {
    // Upload
    Route::post('themes/upload', 'ThemeController@upload')->name('themes.upload');

    // List
    Route::get('themes/{preview}/preview', 'ThemeController@show')->name('themes.preview');
    Route::get('themes', 'ThemeController@index')->name('themes.index');

    // Theme Documentation
    Route::prefix('themes/{preview}/docs')->group(function ($preview) {
        Route::get('/', function ($preview) {
            return redirect()->route('documentations.show', [$preview, 'Alerts']);
        })->name('documentations.themes');

        Route::get('{component}', 'DocumentationController@show')->name('documentations.show');
    });
});

