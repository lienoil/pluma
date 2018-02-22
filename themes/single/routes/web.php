<?php

use Frontier\Composers\NavigationViewComposer;
use Illuminate\Http\Request;
use Pluma\Support\Facades\Route;

Route::get('admin', function () {
  return redirect()->route('dashboard');
})->middleware(['auth.admin', 'cors']);

Route::any('admin/{slug?}', function () {
    return view("Theme::layouts.admin");
})->middleware(['auth.admin', 'cors'])->where('slug', '.*');

Route::group(['prefix' => 'api/v1', 'middleware' => ['api', 'cors']], function () {
    Route::post('misc/breadcrumbs', function (Request $request) {
        $composer = new NavigationViewComposer();
        $composer->setMenus(
            $composer->requireFileFromModules(
                'config/menus.php',
                modules(true, null, false)
            )
        );
        $composer->setCurrentUrl($request->input('path'));
        $composer->setCurrentRouteName($request->input('routename'));
        $composer->setBreadcrumbs($composer->getCurrentUrl());
        $breadcrumbs = $composer->handle()->breadcrumbs->collect;
        return response()->json($breadcrumbs);
    })->name('api.misc.breadcrumbs');
});

Route::any('{slug?}', function () {
    return view("Theme::layouts.public");
})->where('slug', '.*');
