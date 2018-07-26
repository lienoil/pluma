<?php

require_once __DIR__ . '/admin-mycourses.php';

Route::softDeletes('courses', 'CourseController');

Route::resource('courses', 'CourseController', ['module' => 'Pluma']);

// Route::post('courses', 'CourseController@store')->name('courses.store');
