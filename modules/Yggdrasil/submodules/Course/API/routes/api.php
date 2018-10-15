<?php

// Scormvar
Route::get('scorm/courses/{course}/{content}', '\Course\API\Controllers\ScormvarController@LMSGetValue')->name('scorm.lmsgetvalue');
Route::post('scorm/courses/{course}/{content}/init', '\Course\API\Controllers\ScormvarController@LMSInitialize')->name('scorm.lmsinitialize');
Route::post('scorm/courses/{course}/{content}', '\Course\API\Controllers\ScormvarController@LMSSetValue')->name('scorm.lmssetvalue');
Route::post('scorm/courses/{course}/{content}/commit', '\Course\API\Controllers\ScormvarController@LMSCommit')->name('scorm.lmscommit');
Route::post('scorm/courses/{course}/{content}/finish', '\Course\API\Controllers\ScormvarController@LMSFinish')->name('scorm.lmsfinish');

// Bookmark
Route::post('courses/unbookmark/{course}', '\Course\API\Controllers\BookmarkCourseController@unbookmark')->name('courses.bookmark.unbookmark');
Route::post('courses/bookmark/{course}', '\Course\API\Controllers\BookmarkCourseController@bookmark')->name('courses.bookmark.bookmark');

// My
Route::get('course/enrolled', '\Course\API\Controllers\MyCourseController@all')->name('courses.enrolled.index');
