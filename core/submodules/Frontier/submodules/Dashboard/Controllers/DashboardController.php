<?php

namespace Dashboard\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
