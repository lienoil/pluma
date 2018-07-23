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

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        return view("Test::tests.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view("Test::tests.create");
    }
}
