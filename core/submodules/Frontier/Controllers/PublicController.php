<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;
use Frontier\Support\View\CheckView;
use Pluma\Models\Task;

class PublicController
{
    use CheckView;

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
        return $this->view($slug, "Frontier::welcome.");
    }
}
