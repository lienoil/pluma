<?php

Route::delete('library/destroy/many', 'LibraryManyController@destroy')->name('library.many.destroy');
Route::post('library/restore/many', 'LibraryManyController@restore')->name('library.many.restore');

Route::get('library/trash', 'LibraryController@trash')->name('library.trash');
Route::resource('library', 'LibraryController');
