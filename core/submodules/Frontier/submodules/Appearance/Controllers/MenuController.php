<?php

namespace Frontier\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Frontier\Models\Page;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menus['pages'] = Page::all();

        return view("Appearance::menus.index")->with(compact('menus'));
    }

    /**
     * Show a given page resource.
     *
     * @param  Request $request
     * @param  string  $slug
     * @return Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }
}
