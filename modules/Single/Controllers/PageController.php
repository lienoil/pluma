<?php

namespace Single\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Pluma\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Displays the root page.
     *
     * @param  Request $request
     * @return Illuminate\View\View
     */
    public function getRootPage(Request $request)
    {
        return view("Single::layouts.admin");
    }

    /**
     * Displays the unsupported browser message.
     *
     * @param  Request $request
     * @return Illuminate\View\View
     */
    public function getUnsupportedBrowserPage(Request $request)
    {
        return view("Single::errors.unsupported");
    }
}
