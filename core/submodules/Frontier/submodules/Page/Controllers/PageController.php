<?php

namespace Page\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Page::pages.index");
    }
}
