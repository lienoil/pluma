<?php

Route::any('p/admin/{slug?}', function () {
    return view("Theme::app");
})->where('slug', '.*');
