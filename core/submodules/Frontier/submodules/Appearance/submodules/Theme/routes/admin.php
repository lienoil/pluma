<?php

// Upload
Route::post('appearance/themes/upload', 'Theme\Controllers\ThemeController@upload')->name('themes.upload');

// List
Route::get('appearance/themes/{preview}/preview', 'Theme\Controllers\ThemeController@preview')->name('themes.preview');
Route::get('appearance/themes', 'Theme\Controllers\ThemeController@index')->name('themes.index');
