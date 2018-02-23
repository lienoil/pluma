<?php

namespace Student\Controllers;

use Student\Models\Student;
use Student\Requests\StudentRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class StudentController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::students.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::students.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::students.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Student\Requests\StudentRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        //

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::students.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Student\Requests\StudentRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return back();
    }
}
