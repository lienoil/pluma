<?php

Route::get('core/{file?}', function ($file = null) {
    $path = core_path("assets/$file");
    $fileArray = explode('/', $file);
    $lastFile = end($fileArray);
    $extension = explode(".", $lastFile);
    $fileExtension = end($extension);
    $isCss = 'css' === $fileExtension ? true : false;

    if (! in_array($fileExtension, config('downloadables', []))) {
        return abort(403);
    }

    if (\File::exists($path)) {
        return response()->file($path, $isCss ? array('Content-Type' => 'text/css') : []);
    }

    return abort(404);
})->where('file', '.*');

Route::get('storage/{file?}', function ($file = null) {
    $path = storage_path("$file");
    $fileArray = explode('/', $file);
    $lastFile = end($fileArray);
    $extension = explode(".", $lastFile);
    $fileExtension = end($extension);
    $isCss = 'css' === $fileExtension ? true : false;

    if (! in_array($fileExtension, config('downloadables', []))) {
        return abort(403);
    }

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

    if (! in_array($fileExtension, config('downloadables', []))) {
        return abort(403);
    }

    if (\File::exists($path)) {
        return response()->file($path, $isCss ? array('Content-Type' => 'text/css') : []);
    }

    return abort(404);
})->where('file', '.*');

Route::get('~p/{module?}/{file?}', function ($module = null, $file = null) {
    $module = ucfirst($module);
    $path = get_module($module)."/views/$file";

    $fileArray = explode('/', $file);
    $lastFile = end($fileArray);
    $extension = explode(".", $lastFile);
    $fileExtension = end($extension);
    $isCss = 'css' === $fileExtension ? true : false;

    if (! in_array($fileExtension, config('downloadables', []))) {
        return abort(403);
    }

    if (\File::exists($path)) {
        return response()->file($path, $isCss ? array('Content-Type' => 'text/css') : []);
    }

    return abort(404);
})->where('file', '.*');

Route::get('themes/{file?}', function ($file = null) {
    $path = base_path(config('path.themes', 'themes').'/'.config('settings.active_theme', 'default'))."/assets/$file";
    $fileArray = explode('/', $file);
    $lastFile = end($fileArray);
    $extension = explode(".", $lastFile);
    $fileExtension = end($extension);
    $isCss = 'css' === $fileExtension ? true : false;

    if (! in_array($fileExtension, config('downloadables', []))) {
        return abort(403);
    }

    if (\File::exists($path)) {
        return response()->file($path, $isCss ? array('Content-Type' => 'text/css') : []);
    }

    return abort(404);
})->where('file', '.*');

Route::get('anytheme/{file?}', function ($file = null) {
    $path = themes_path("$file");
    $fileArray = explode('/', $file);
    $lastFile = end($fileArray);
    $extension = explode(".", $lastFile);
    $fileExtension = end($extension);
    $isCss = 'css' === $fileExtension ? true : false;

    if (! in_array($fileExtension, config('downloadables', []))) {
        return abort(403);
    }

    if (\File::exists($path)) {
        return response()->file($path, $isCss ? array('Content-Type' => 'text/css') : []);
    }

    return abort(404);
})->where('file', '.*');
