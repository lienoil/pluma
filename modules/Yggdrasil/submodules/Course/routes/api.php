<?php

use Course\Models\Course;
use Course\Resources\CourseCollection;

// route: /api/v1
Route::group(['prefix' => 'v1', 'middleware' => 'auth'], function () {
    Route::get('courses/all', 'CourseController@getAll')->name('courses.all');
    Route::delete('courses/{course}', 'CourseController@deleteDestroy')->name('courses.destroy');
    Route::post('courses/{course}', 'CourseController@postRestore')->name('courses.restore');
    Route::get('courses/search', 'CourseController@postFind')->name('courses.search');
    Route::get('courses/{course}', 'CourseController@getShow')->name('courses.show');
    Route::post('courses/store', 'CourseController@postStore')->name('courses.store');
    Route::put('courses/update', 'CourseController@putUpdate')->name('courses.update');

});
