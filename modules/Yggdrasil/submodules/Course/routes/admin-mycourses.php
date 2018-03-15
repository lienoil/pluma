<?php

Route::group(['prefix' => 'courses'], function () {
    Route::get('current', 'CourseController@current')->name('courses.my');
});
