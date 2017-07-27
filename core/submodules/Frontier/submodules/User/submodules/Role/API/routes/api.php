<?php

Route::get('permissions/all', 'Role\API\Controllers\PermissionController@getAll')->name('permissions.all');
