<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;
use Pluma\Models\Task;

class PublicController
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return dd($request);
    }

    /**
     * Show a given page resource.
     *
     * @param  Request $request
     * @param  string  $slug
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $slug = null)
    {
        $view  = "Frontier::$slug.show";

        if (is_null($slug)) {
            $view = "Frontier::welcome.welcome"; // settings("site.urls.home", "/");
        }

        // $tasks = Task::all();
        // dd($tasks);

        return view("$view")->with(['message' => 'Hello World!']);
    }
}
