<?php

Route::delete('forums/delete/many', 'ForumManyController@delete')->name('forums.many.delete');
Route::delete('forums/delete/{forum}', 'ForumController@delete')->name('forums.delete');
Route::delete('forums/destroy/many', 'ForumManyController@destroy')->name('forums.many.destroy');
Route::get('forums/refresh', 'ForumRefreshController@index')->name('forums.refresh.index');
Route::get('forums/trash', 'ForumController@trash')->name('forums.trash');
Route::post('forums/refresh', 'ForumRefreshController@refresh')->name('forums.refresh.refresh');
Route::post('forums/restore/many', 'ForumManyController@restore')->name('forums.many.restore');
Route::post('forums/{forum}/restore', 'ForumController@restore')->name('forums.restore');
Route::resource('forums', 'ForumController');
