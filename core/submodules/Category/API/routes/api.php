<?php

Route::get('categories/all', 'Category\API\Controllers\CategoryController@all')->name('categories.all');
Route::get('categories/search', 'Category\API\Controllers\CategoryController@search')->name('categories.search');
Route::post('categories/store', 'Category\API\Controllers\CategoryController@store')->name('categories.store');

// Route::delete('categories/destroy/{category}', 'Category\API\Controllers\CategoryController@destroy')->name('categories.destroy');
// Route::delete('categories/delete/{category}', 'Category\API\Controllers\CategoryController@delete')->name('categories.delete');
// Route::get('categories/paginated', 'Category\API\Controllers\CategoryController@paginated')->name('categories.paginated');
// Route::get('categories/trash/all', 'Category\API\Controllers\CategoryController@getTrash')->name('categories.trash.all');
// Route::post('categories/{category}/clone', 'Category\API\Controllers\CategoryController@clone')->name('categories.clone');
// Route::post('categories/{category}/restore', 'Category\API\Controllers\CategoryController@restore')->name('categories.restore');
