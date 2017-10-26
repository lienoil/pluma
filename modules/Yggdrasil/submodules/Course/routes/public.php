<?php

// Public Courses
Route::get('courses', 'Course\Controllers\CourseController@index')->name('courses.index');

// Bookmarks
Route::post('courses/unbookmark/{course}', 'Course\Controllers\BookmarkCourseController@unbookmark')->name('courses.unbookmark');
Route::post('courses/bookmark/{course}', 'Course\Controllers\BookmarkCourseController@bookmark')->name('courses.bookmark');

// My
Route::get('courses/enrolled/{course}', 'Course\Controllers\MyCourseController@show')->name('my.courses.show');
Route::get('courses/enrolled', 'Course\Controllers\MyCourseController@index')->name('my.courses.index');
