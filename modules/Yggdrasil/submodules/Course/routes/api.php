<?php

use Course\Models\Course;
use Course\Resources\CourseCollection;

// route: /api/v1
Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    // Route::get('courses/all', 'CourseController@getAll');
    Route::get('courses/all', function () {
        return new CourseCollection(Course::all());
    });
});
