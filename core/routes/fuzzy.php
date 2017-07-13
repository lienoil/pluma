<?php

Route::get('core/{file?}', function ($file = null) {
    $path = core_path("assets/$file");
    $fileArray = explode('/', $file);
    $lastFile = end($fileArray);
    $extension = explode(".", $lastFile);
    $fileExtension = end($extension);
    $isCss = 'css' === $fileExtension ? true : false;

    if (\File::exists($path)) {
        return response()->file($path, $isCss ? array('Content-Type' => 'text/css') : []);
    }

    return abort(404);
})->where('file', '.*');

Route::get('~assets/{module?}/{file?}', function ($module = null, $file = null) {
    $module = ucfirst($module);
    $path = get_module($module)."/assets/$file";
    $fileArray = explode('/', $file);
    $lastFile = end($fileArray);
    $extension = explode(".", $lastFile);
    $fileExtension = end($extension);
    $isCss = 'css' === $fileExtension ? true : false;

    if (\File::exists($path)) {
        return response()->file($path, $isCss ? array('Content-Type' => 'text/css') : []);
    }

    return abort(404);
})->where('file', '.*');

Route::get('~p/{module?}/{csrf?}/{file?}', function ($module = null, $csrf = null, $file = null) {
    if ($csrf !== csrf_token()) {
        return abort(404);
    }

    $module = ucfirst($module);
    $path = get_module($module)."/presentations/$file";

    $fileArray = explode('/', $file);
    $lastFile = end($fileArray);
    $extension = explode(".", $lastFile);
    $fileExtension = end($extension);
    $isCss = 'css' === $fileExtension ? true : false;

    if (\File::exists($path)) {
        return response()->file($path, $isCss ? array('Content-Type' => 'text/css') : []);
    }

    return abort(404);
})->where('file', '.*');
