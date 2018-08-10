<?php

require_once __DIR__ . '/admin-mycourses.php';
require_once __DIR__ . '/admin-bookmarked.php';

Route::resource('courses', 'CourseController');
