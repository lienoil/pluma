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
    // $module = ucfirst($module);
    // $path = get_module($module) . "/assets/$file";
    // $fileArray = explode('/', $file);
    // $lastFile = end($fileArray);
    // $extension = explode(".", $lastFile);
    // $fileExtension = end($extension);

    // if (in_array($fileExtension, config('download.restricted', []))) {
    //     return abort(403);
    // }

    // if (File::exists($path)) {
    //     $mime = File::mimeType($path);
    //     dd($mime);
    //     // return response()->file($path, array('Content-Type' => $mime));
    // }

    // return abort(404);
})->where('file', '.*');
