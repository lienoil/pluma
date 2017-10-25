<?php

Route::delete('course/packages/destroy/many', 'Package\Controllers\PackageManyController@destroy')->name('packages.many.destroy');

Route::resource('courses/packages', 'Package\Controllers\PackageController');
