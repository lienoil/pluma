<?php

Route::group(['prefix' => 'courses'], function () {
    Route::get('current', 'CourseController@current')->name('courses.my');
    Route::post('{course}/request', 'CourseController@request')->name('courses.request');
});
