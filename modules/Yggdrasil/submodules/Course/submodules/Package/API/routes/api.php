<?php

Route::post('packages/upload', '\Package\API\Controllers\PackageController@upload')->name('packages.upload');
Route::get('packages/paginated', '\Package\API\Controllers\PackageController@paginated')->name('packages.paginated');
Route::get('packages/search', '\Package\API\Controllers\PackageController@search')->name('packages.search');
