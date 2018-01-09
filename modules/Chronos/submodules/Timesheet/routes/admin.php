<?php

Route::post('timesheets/{timesheet}/generate', 'TimesheetController@generate')->name('timesheets.generate');
Route::get('timesheets/{handlename}/all', 'TimesheetController@show')->name('timesheets.show');

Route::resource('timesheets', 'TimesheetController')->except(['show']);
