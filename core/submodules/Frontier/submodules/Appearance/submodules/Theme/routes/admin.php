<?php

Route::get('appearance/themes/{preview}/preview', 'Theme\Controllers\ThemeController@preview')->name('themes.preview');
Route::get('appearance/themes', 'Theme\Controllers\ThemeController@index')->name('themes.index');
