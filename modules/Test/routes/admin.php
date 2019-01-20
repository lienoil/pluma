<?php

# Owned resource
Route::get('tests/owned', 'TestController@owned')->name('tests.owned');

# SoftDelete routes
Route::softDeletes('tests', 'TestController');

# Main resource
Route::resource('tests', 'TestController');
