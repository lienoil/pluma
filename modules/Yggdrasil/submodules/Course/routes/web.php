<?php

/**
 *------------------------------------------------------------------------------
 * Public Route
 *------------------------------------------------------------------------------
 *
 * Handles the public facing routes.
 *
 */

// Bookmarks
Route::post('courses/unbookmark/{course}', '\Course\Controllers\BookmarkCourseController@unbookmark')->name('courses.bookmark.unbookmark');
Route::post('courses/bookmark/{course}', '\Course\Controllers\BookmarkCourseController@bookmark')->name('courses.bookmark.bookmark');
Route::get('courses/bookmarked', '\Course\Controllers\BookmarkCourseController@index')->name('courses.bookmark.index');

// Enrolled
Route::get('courses/enrolled/{course}', '\Course\Controllers\EnrollController@show')->name('courses.enrolled.show');
Route::get('courses/enrolled', '\Course\Controllers\EnrollController@index')->name('courses.enrolled.index');

// Enroll
Route::get('courses/enroll', '\Course\Controllers\EnrollController@index')->name('courses.enroll.index');

// Public Courses
Route::get('courses/{course}', 'CourseController@single')->name('courses.single');
Route::get('courses', 'CourseController@all')->name('courses.all');
