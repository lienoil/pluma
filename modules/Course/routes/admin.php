<?php

/**
 *------------------------------------------------------------------------------
 * Admin Course Route
 *------------------------------------------------------------------------------
 *
 * Handles the admin routes.
 *
 */

// SoftDelete routes
Route::get('courses/trashed', 'CourseController@trashed')
     ->name('courses.trashed');

Route::patch('courses/restore/{course}', 'CourseController@restore')
     ->name('courses.restore');

Route::delete('courses/delete/{course}', 'CourseController@delete')
     ->name('courses.delete');

Route::resource('courses', 'CourseController');
