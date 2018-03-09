<?php

use Frontier\Composers\NavigationViewComposer;
use Illuminate\Http\Request;
use Pluma\Support\Facades\Route;

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

Route::post('admin/sessions', function () {
    return session()->all();
})->middleware('auth.admin')->name('sessions.all');

Route::get('$/routes', function () {
    $routes = navigations('sidebar');
    $data = [];

    foreach ($routes as $route) {
      var_dump($route); exit();
        $data[] = [
            // "methods" => $route->methods(),
            "uri" => "/{$route->url}",
            "name" => $route->routename ?? $route->name,
            "component" =>  $route->component ?? "components/Pluma/Page/Index.vue",
        ];
    }

    return response()->json($data);
})->middleware(['api', 'cors']);
