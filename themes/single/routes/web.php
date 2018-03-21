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
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            $data[] = [
                "title" => '',
                "uri" => "/{$route->uri()}",
                "name" => $route->getAction('as'),
                "component" =>  $route->getAction('component') ?? null,
                // "uri" => str_replace(url('/'), '', ($route->slug ?? url('/'))),
                // "name" => $route->routename ?? $route->name,
            ];
        }

        return response()->json($data ?? []);
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

Route::middleware(['auth.admin', 'api', 'cors'])->group(function () {
    Route::get('chatroom/public/messages', function () {
        return response()->json(['message' => 'Hello', 'user_id' => 1]);
    });
});
