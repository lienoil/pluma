<?php

Route::delete('library/destroy/many', 'Library\Controllers\LibraryManyController@destroy')->name('library.many.destroy');
Route::post('library/restore/many', 'Library\Controllers\LibraryManyController@restore')->name('library.many.restore');

Route::get('library/trash', 'Library\Controllers\LibraryController@trash')->name('library.trash');
Route::resource('library', 'Library\Controllers\LibraryController');
