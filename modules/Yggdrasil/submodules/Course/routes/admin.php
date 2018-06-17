<?php

Route::softDeletes('courses', 'CourseController');

Route::resource('courses', 'CourseController');
