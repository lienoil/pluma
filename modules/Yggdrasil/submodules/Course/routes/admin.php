<?php

Route::get('courses/categories', 'Course\Controllers\CategoryController@index')->name('courses.categories.index');
Route::resource('courses', 'Course\Controllers\CourseController');
