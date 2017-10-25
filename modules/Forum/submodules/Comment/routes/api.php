<?php

Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => ['api']], function () {
    Route::post('comments/lists', 'Comment\Controllers\API\CommentController@index')->name('comments.lists');
    Route::post('comments/store', 'Comment\Controllers\API\CommentController@store')->name('comments.store');
    Route::post('comments/update', 'Comment\Controllers\API\CommentController@update')->name('comments.update');
});
