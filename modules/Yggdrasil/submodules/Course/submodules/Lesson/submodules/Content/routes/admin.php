<?php

// Route::resource('{courses}/{lessons}/contents', 'Content\Controllers\ContentController');

//Comment
Route::post('contents/{content}/comment', '\Content\Controllers\ContentController@comment')->name('contents.comment');


Route::group(['prefix' => 'courses/{course}/{lessons}'], function () {
    Route::get('{content}', '\Content\Controllers\ContentController@show')->name('contents.show');
});
