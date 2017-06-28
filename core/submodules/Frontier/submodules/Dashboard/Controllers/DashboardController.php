<?php

namespace Dashboard\Controllers;

use Illuminate\Http\Request;

class DashboardController
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Dashboard::dashboard.index");
    }
}
