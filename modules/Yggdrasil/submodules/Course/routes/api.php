<?php

use Course\Models\Course;
use Course\Resources\CourseCollection;

// route: /api/v1
Route::group(['prefix' => 'v1'], function () {
    Route::api('courses', 'CourseApiController');
});
// Route::get('all', 'CourseApiController@getAll')->name('courses.all');

// Route::group(['prefix' => 'v1/courses'], function () {
    // Route::get('all', 'CourseController@getAll')->name('courses.all');
//     Route::get('search', 'CourseController@postFind')->name('courses.search');
//     Route::post('store', 'CourseController@postStore')->name('courses.store');
//     Route::put('update', 'CourseController@putUpdate')->name('courses.update');
//     Route::get('{course}', 'CourseController@getShow')->name('courses.show');
//     Route::delete('{course}', 'CourseController@deleteDestroy')->name('courses.destroy');
//     Route::post('{course}', 'CourseController@postRestore')->name('courses.restore');
// });
