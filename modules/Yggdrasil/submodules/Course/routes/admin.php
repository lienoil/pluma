<?php

require_once __DIR__ . '/admin-mycourses.php';
require_once __DIR__ . '/admin-bookmarked.php';

Route::softDeletes('courses', 'CourseController');

Route::resource('courses', 'CourseController', ['module' => 'Pluma']);

// Route::post('courses', 'CourseController@store')->name('courses.store');
