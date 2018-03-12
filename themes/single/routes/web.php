<?php

use Frontier\Composers\NavigationViewComposer;
use Illuminate\Http\Request;
use Pluma\Support\Facades\Route;

Route::group(['prefix' => 'api/v1', 'middleware' => ['api', 'cors']], function () {
    # Breadcrumbs
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

    # Routes
    Route::get('misc/routes', function () {
        $routes = navigations('sidebar', false)->flat;
        $data = [];

        foreach ($routes as $route) {
            // if (isset($route->slug) && $route->slug === url('admin/pages')) {
            //     var_dump($route); exit();
            // }
            $data[] = [
                // "methods" => $route->methods(),
                "title" => $route->labels->title ?? '',
                "uri" => str_replace(url('/'), '', ($route->slug ?? url('/'))),
                "name" => $route->routename ?? $route->name,
                "component" =>  $route->component ?? "components/Pluma/Page/Edit.vue",
            ];
        }

        return response()->json($data);
    });

    # Routes
    Route::get('misc/navigations/sidebar', function () {
        $data = navigations('sidebar');
        return response()->json($data);
    });
});

Route::post('admin/sessions', function () {
    return session()->all();
})->middleware('auth.admin')->name('sessions.all');
