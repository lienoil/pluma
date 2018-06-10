<?php

Route::softDeletes('tasks', 'TaskController');

Route::resource('tasks', 'TaskController');
