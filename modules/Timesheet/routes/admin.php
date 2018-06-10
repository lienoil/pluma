<?php

Route::softDeletes('timesheets', 'TimesheetController');

Route::resource('timesheets', 'TimesheetController');
