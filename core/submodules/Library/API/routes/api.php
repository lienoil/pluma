<?php

Route::delete('library/destroy/{library}', 'Library\API\Controllers\LibraryController@destroy')->name('library.destroy');
Route::delete('library/delete/{library}', 'Library\API\Controllers\LibraryController@delete')->name('library.delete');
Route::get('library/all', 'Library\API\Controllers\LibraryController@all')->name('library.all');
Route::get('library/search', 'Library\API\Controllers\LibraryController@search')->name('library.search');
Route::get('library/trash/all', 'Library\API\Controllers\LibraryController@getTrash')->name('library.trash.all');
Route::post('library/grants', 'Library\API\Controllers\LibraryController@grants')->name('library.grants');
Route::post('library/{library}/clone', 'Library\API\Controllers\LibraryController@clone')->name('library.clone');
Route::post('library/upload', 'Library\API\Controllers\LibraryController@upload')->name('library.upload');
Route::post('library/{library}/restore', 'Library\API\Controllers\LibraryController@restore')->name('library.restore');
