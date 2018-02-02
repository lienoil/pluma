<?php

/**
 *------------------------------------------------------------------------------
 * Admin Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

//Comment
Route::post('courses/{course}/comment', '\Course\Controllers\CourseController@comment')->name('courses.comment');

// Enroll
Route::get('enroll/{course}/{user}', '\Course\Controllers\EnrollController@enroll');
Route::post('courses/{course}/{user}', '\Course\Controllers\EnrollController@enroll')->name('courses.enroll');

// Course
Route::get('courses/categories', 'CategoryController@index')->name('courses.categories.index');
Route::resource('courses', 'CourseController');

