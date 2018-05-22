<?php

use Frontier\Composers\NavigationViewComposer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Pluma\Support\Facades\Route;

# Simple Pages
Route::get('403', function () {
    return response()->view("Theme::errors.403", [], 403);
});

Route::group(['prefix' => 'api/v1', 'middleware' => ['api', 'cors']], function () {
    # User
    Route::get('auth/user', function () {
        return response()->json([
            'user' => user(),
            'isRoot' => user()->isRoot(),
            'permissions' => user()->permissions->pluck('code'),
        ]);
    })->middleware('auth.admin');

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
        return response()->json(navigations('sidebar'));
    });

    # Permissions
    Route::get('user/can', function (Request $request) {
        return response()->json(user()->can($request->get('permission')));
    })->middleware('auth.admin');
});

Route::post('admin/sessions', function () {
    return session()->all();
})->middleware('auth.admin')->name('sessions.all');

Route::middleware(['auth.admin', 'api', 'cors'])->group(function () {
    // Route::get('chatroom/public/messages', function () {
    //     return response()->json(['message' => 'Hello', 'user_id' => 1]);
    // });
});
