<?php

use Course\Models\Course;
use Course\Resources\CourseCollection;

// route: /api/v1
// 'middleware' => 'auth:api'
Route::group(['prefix' => 'v1'], function () {
    // Route::get('courses/all', 'CourseController@getAll');
    Route::get('courses/all', function () {
        return new CourseCollection(Course::all());
    });
});
