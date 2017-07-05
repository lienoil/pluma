<?php

Route::get('/', 'Single\Controllers\PageController@getRootPage');

Route::get('/unsupported-browser', 'Single\Controllers\PageController@getUnsupportedBrowserPage');
