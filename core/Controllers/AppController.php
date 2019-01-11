<?php

namespace Pluma\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class AppController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Theme::app.index');
    }
}
