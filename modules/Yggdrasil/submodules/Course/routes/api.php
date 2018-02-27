<?php

/**
 *------------------------------------------------------------------------------
 * API Routes
 *------------------------------------------------------------------------------
 *
 * Handles the API routes.
 *
 */

// Course
Route::group(['prefix' => 'v1'], function () {
    Route::get('courses/all', 'CourseController@getAll')->name('courses.all');
    Route::get('courses/find', 'CourseController@postFind')->name('courses.find');
    Route::get('courses/search', 'CourseController@postFind')->name('courses.search');
    Route::get('courses/{course}', 'CourseController@getShow')->name('courses.show');
    Route::delete('courses/{course}', 'CourseController@deleteDestroy')->name('courses.destroy');

    //Students
    Route::get('students/all', 'StudentController@getAll')->name('students.all');
    // Route::get('students/find', 'StudentController@postFind')->name('students.find');
    // Route::get('students/search', 'StudentController@postFind')->name('students.search');
    // Route::get('students/{student}', 'StudentController@getShow')->name('students.show');
    // Route::delete('students/{student}', 'StudentController@deleteDestroy')->name('students.destroy');
});
