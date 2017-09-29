<?php

Route::get('f/{slug?}', 'Frontman\Controllers\FrontmanController@get')
    ->name('frontman.app')
    ->where('slug', '.*');
