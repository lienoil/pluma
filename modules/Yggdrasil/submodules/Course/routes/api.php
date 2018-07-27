<?php

use Course\Models\Course;
use Course\Resources\CourseCollection;

Route::group(['prefix' => 'v1'], function () {
    Route::api('courses', 'CourseApiController');
});
