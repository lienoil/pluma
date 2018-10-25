<?php

Route::middleware(['auth.admin'])->get('themes/preview', function () {
    return view('Theme::tests.components');
});
