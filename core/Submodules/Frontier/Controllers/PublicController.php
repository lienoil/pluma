<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;

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
        if (is_null($slug)) {
            $slug = "Welcome"; // settings("site.urls.home", "/");
        }

        return $slug;
        // return view("$slug");
    }
}
