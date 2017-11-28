<?php

// Many
Route::delete('pages/delete/many', 'Page\Controllers\PageManyController@delete')->name('pages.many.delete');
Route::delete('pages/destroy/many', 'Page\Controllers\PageManyController@destroy')->name('pages.many.destroy');
Route::post('pages/restore/many', 'Page\Controllers\PageManyController@restore')->name('pages.many.restore');

// Additionals
Route::delete('pages/delete/{page}', 'Page\Controllers\PageController@delete')->name('pages.delete');
Route::get('pages/trash', 'Page\Controllers\PageController@trash')->name('pages.trash');
Route::post('pages/{page}/restore', 'Page\Controllers\PageController@restore')->name('pages.restore');

// Main
Route::resource('pages', 'Page\Controllers\PageController');
