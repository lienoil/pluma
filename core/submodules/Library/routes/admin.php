<?php

Route::delete('library/destroy/many', 'LibraryManyController@destroy')->name('library.many.destroy');
Route::post('library/restore/many', 'LibraryManyController@restore')->name('library.many.restore');

Route::get('library/trash', 'LibraryController@trash')->name('library.trash');
Route::resource('library', 'LibraryController');

Route::post('library/upload', 'LibraryController@upload')->name('library.upload');

Route::resouce('library', 'LibraryController', ['middleware' => 'breadcrumbs:\User\Models\User'])
