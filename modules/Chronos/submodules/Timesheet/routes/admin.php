<?php

Route::post('timesheets/{timesheet}/generate', 'Timesheet\Controllers\TimesheetController@generate')->name('timesheets.generate');
Route::get('timesheets/{handlename}/all', 'Timesheet\Controllers\TimesheetController@show')->name('timesheets.show');

Route::resource('timesheets', 'Timesheet\Controllers\TimesheetController')->except(['show']);
