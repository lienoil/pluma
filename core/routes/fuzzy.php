<?php

Route::get('themes/{file?}', function ($file = null) {
    $path = themes_path(settings('active_theme', 'default')."/$file");
    $extension = File::extension($path);

    if (in_array($extension, config('download.restricted', []))) {
        return abort(403);
    }

    if (File::exists($path)) {
        $contentType = config("mimetypes.$extension", 'txt');

        return response()->file($path, array('Content-Type' => $contentType));
    }

    return abort(404);

    $path = base_path(config('path.themes', 'themes').'/'.settings('active_theme', 'default'))."/$file";
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
