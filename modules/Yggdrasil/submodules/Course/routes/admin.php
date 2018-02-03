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
Route::get('enroll/{course}', '\Course\Controllers\EnrollController@show')->name('courses.enroll.index');
Route::post('courses/{course}/{user}', '\Course\Controllers\EnrollController@enroll')->name('courses.enroll');

// Profile
Route::get('profile/{handle}/courses', 'CourseProfileController@show')->name('profile.courses.show');

// Categories
Route::get('courses/categories', 'CategoryController@index')->name('courses.categories.index');

// SoftDelete routes
Route::get('courses/trashed', 'CourseController@trashed')
     ->name('courses.trashed');

Route::patch('courses/restore/{course}', 'CourseController@restore')
     ->name('courses.restore');

Route::delete('courses/delete/{course}', 'CourseController@delete')
     ->name('courses.delete');

// Course
Route::resource('courses', 'CourseController');

