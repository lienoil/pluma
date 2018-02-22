<?php

include __DIR__ . '/api.php';

Route::any('poly/admin/{slug?}', function () {
    return view("Theme::app");
})->middleware(['auth.admin'])->where('slug', '.*');
