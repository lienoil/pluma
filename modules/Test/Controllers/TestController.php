<?php

namespace Test\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class TestController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view("Test::tests.index");
    }
}
