<?php

Route::get('appearance/themes/{preview}/preview', 'Theme\Controllers\ThemeController@preview')->name('themes.preview');
Route::resource('appearance/themes', 'Theme\Controllers\ThemeController');
