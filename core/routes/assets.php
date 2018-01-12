<?php

use Illuminate\Support\Facades\File;

/**
 * -----------------------------------------------------------------------------
 * Assets Routes
 * -----------------------------------------------------------------------------
 *
 * This file is where you may define all of your Assets based urls.
 *
 */

Route::get('assets/{module?}/{file?}', function ($module = null, $file = null) {
    $path = get_module($module) . "/assets/$file";
    $extension = File::extension($path);

    if (in_array($extension, config('download.restricted', []))) {

        return abort(403);
    }

    if (File::exists($path)) {
        $contentType = config("mimetypes.$extension", 'txt');

        return response()->file($path, array('Content-Type' => $contentType));
    }

    return abort(404);
})->where('file', '.*');

Route::get('core/{file?}', function ($file = null) {
    $path = core_path("assets/$file");
    $extension = File::extension($path);

    if (in_array($extension, config('download.restricted', []))) {

        return abort(403);
    }

    if (File::exists($path)) {
        $contentType = config("mimetypes.$extension", 'txt');

        return response()->file($path, array('Content-Type' => $contentType));
    }

    return abort(404);
})->where('file', '.*');
