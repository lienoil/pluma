<?php


// Categories
Route::get('tests/octocats', 'OctocatController@index')->name('tests.octocats.index');


Route::resource('octocats', 'OctocatController');
