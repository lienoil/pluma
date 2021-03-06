<?php

Route::group(['prefix' => 'courses'], function () {
    Route::get('bookmarked', 'CourseController@bookmarked')->name('courses.bookmarked');
    Route::post('{course}/bookmark', 'BookmarkCourseController@bookmark')->name('courses.bookmark');
    Route::patch('{course}/unbookmark', 'BookmarkCourseController@unbookmark')->name('courses.unbookmark');
});
