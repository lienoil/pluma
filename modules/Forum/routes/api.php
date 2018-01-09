<?php

Route::post('forums/{id}/comment', '\Forum\Controllers\API\ForumController@comment')->name('api.forums.comment');
Route::post('forums/{id}/all', '\Forum\Controllers\API\ForumController@all')->name('api.forums.all');
Route::post('forums/{id}/update', '\Forum\Controllers\API\ForumController@update')->name('api.forums.update');
