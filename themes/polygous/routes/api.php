<?php

use Frontier\Composers\NavigationViewComposer;

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
