<?php

namespace Course\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class CourseController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view("Course::courses.index");
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

        return view("Course::courses.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        return view("Course::courses.create");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {

        return view("Course::courses.trashed");
    }
}
