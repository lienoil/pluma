<?php

// require __DIR__.'/admin-mycourses.php';

// Route::softDeletes('courses', 'CourseController');
Route::api('courses', 'CourseApiController');
Route::resource('courses', 'CourseController');
