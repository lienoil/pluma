<?php

// Many
Route::delete('pages/delete/many', 'PageManyController@delete')->name('pages.many.delete');
Route::delete('pages/destroy/many', 'PageManyController@destroy')->name('pages.many.destroy');
Route::post('pages/restore/many', 'PageManyController@restore')->name('pages.many.restore');

// Additionals
Route::delete('pages/delete/{page}', 'PageController@delete')->name('pages.delete');
Route::get('pages/trash', 'PageController@trash')->name('pages.trash');
Route::post('pages/{page}/restore', 'PageController@restore')->name('pages.restore');

// Admin
Route::resource('pages', 'PageController');
