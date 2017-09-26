<?php

Route::delete('courses/destroy/{course}', 'Course\API\Controllers\CourseController@destroy')->name('courses.destroy');
Route::delete('courses/delete/{course}', 'Course\API\Controllers\CourseController@delete')->name('courses.delete');
Route::get('courses/all', 'Course\API\Controllers\CourseController@all')->name('courses.all');
Route::get('courses/search', 'Course\API\Controllers\CourseController@search')->name('courses.search');
Route::get('courses/trash/all', 'Course\API\Controllers\CourseController@getTrash')->name('courses.trash.all');
Route::post('courses/grants', 'Course\API\Controllers\CourseController@grants')->name('courses.grants');
Route::post('courses/{course}/clone', 'Course\API\Controllers\CourseController@clone')->name('courses.clone');
Route::post('courses/{course}/restore', 'Course\API\Controllers\CourseController@restore')->name('courses.restore');
