<?php

Route::post('packages/upload', '\Package\API\Controllers\PackageController@upload')->name('packages.upload');
Route::get('packages/paginated', 'P\ackage\API\Controllers\PackageController@paginated')->name('packages.paginated');
