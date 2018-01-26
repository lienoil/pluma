<?php

Route::delete('forums/destroy/{forum}', '\Forum\API\Controllers\ForumController@destroy')->name('forums.destroy');
Route::delete('forums/delete/{forum}', '\Forum\API\Controllers\ForumController@delete')->name('forums.delete');
Route::get('forums/all', '\Forum\API\Controllers\ForumController@all')->name('forums.all');
Route::get('forums/search', '\Forum\API\Controllers\ForumController@search')->name('forums.search');
Route::get('forums/trash/all', '\Forum\API\Controllers\ForumController@getTrash')->name('forums.trash.all');
Route::post('forums/{forum}/clone', '\Forum\API\Controllers\ForumController@clone')->name('forums.clone');
Route::post('forums/{forum}/restore', '\Forum\API\Controllers\ForumController@restore')->name('forums.restore');
