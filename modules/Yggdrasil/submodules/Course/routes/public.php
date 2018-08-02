<?php

Route::get('courses', 'CourseController@all')->name('courses.all');

// Route::get('courses/enrolled/{course}', '')
Route::get('courses/{course}', 'CourseController@single')->name('courses.single');

// Bookmarks
Route::post('courses/unbookmark/{course}', 'BookmarkCourseController@unbookmark')->name('courses.bookmark.unbookmark');
Route::post('courses/bookmark/{course}', 'BookmarkCourseController@bookmark')->name('courses.bookmark.bookmark');
Route::get('courses/bookmarked', 'BookmarkCourseController@index')->name('courses.bookmark.index');
