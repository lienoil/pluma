<?php

require_once __DIR__ . '/admin-mycourses.php';
require_once __DIR__ . '/admin-bookmarked.php';

Route::resource('courses', 'CourseController');

// SoftDelete routes
Route::get('courses/trashed', 'CourseController@trashed')
     ->name('courses.trashed');

Route::patch('courses/restore/{course}', 'CourseController@restore')
     ->name('courses.restore');

Route::delete('courses/delete/{course}', 'CourseController@delete')
     ->name('courses.delete');

// Students
Route::get('courses/{course}/students', 'StudentController@index')->name('courses.students');
Route::post('courses/{course}/students', 'StudentController@store')->name('students.store');
Route::delete('courses/drop/{course}', 'StudentController@drop')->name('students.drop');
