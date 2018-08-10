<?php

// Bookmarks
Route::post('courses/unbookmark/{course}', 'BookmarkCourseController@unbookmark')->name('courses.bookmark.unbookmark');
Route::post('courses/bookmark/{course}', 'BookmarkCourseController@bookmark')->name('courses.bookmark.bookmark');
Route::get('courses/bookmarked', 'BookmarkCourseController@index')->name('courses.bookmark.index');

// Public Courses
Route::get('courses/{course}', 'CourseController@single')->name('courses.single');
Route::get('courses', 'CourseController@all')->name('courses.all');

Route::get('tes/test', function () {
    $course = \Course\Models\Course::findOrFail(1);
    $student = \Course\Models\User::find(1);

    // test, render at browser
    return new \Course\Mail\CourseRequested($course, $student);

    // Send
    return \Illuminate\Support\Facades\Mail::to($student->email)
                ->send(new \Course\Mail\CourseRequested($course, $student));
});
