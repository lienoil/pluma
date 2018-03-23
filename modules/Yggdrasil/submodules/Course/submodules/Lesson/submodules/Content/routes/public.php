<?php

Route::group(['prefix' => 'courses/{course}/{lessons}'], function () {
    Route::get('{content}', '\Content\Controllers\ContentController@show')->name('contents.single');
    // Route::post('{content}', '\Content\Controllers\ContentController@show')->name('contents.single');
});
