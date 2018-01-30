<?php

Route::delete('forums/delete/many', '\Forum\Controllers\ForumManyController@delete')->name('forums.many.delete');
Route::delete('forums/delete/{forum}', '\Forum\Controllers\ForumController@delete')->name('forums.delete');
Route::delete('forums/destroy/many', '\Forum\Controllers\ForumManyController@destroy')->name('forums.many.destroy');
Route::get('forums/refresh', '\Forum\Controllers\ForumRefreshController@index')->name('forums.refresh.index');
Route::get('forums/trash', '\Forum\Controllers\ForumController@trash')->name('forums.trash');
Route::post('forums/refresh', '\Forum\Controllers\ForumRefreshController@refresh')->name('forums.refresh.refresh');
Route::post('forums/restore/many', '\Forum\Controllers\ForumManyController@restore')->name('forums.many.restore');
Route::post('forums/{forum}/restore', '\Forum\Controllers\ForumController@restore')->name('forums.restore');


//Comment
Route::post('forums/{forum}/comment', '\Forum\Controllers\ForumController@comment')->name('forums.comment');

// Category
Route::resource('forums/categories', 'CategoryController', [
    'except' => ['show', 'create'],
    'as' => 'forums',
]);

Route::resource('forums', '\Forum\Controllers\ForumController');
Route::resource('forums', '\Forum\Controllers\ForumController');
