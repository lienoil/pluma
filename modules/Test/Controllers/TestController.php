<?php

namespace Test\Controllers;

use Test\Models\Test;
use Test\Requests\TestRequest;
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
        dd(\Course\Models\User::get());

        $course = \Course\Models\Course::find(1);
        $course->commit(2);

        return view("Theme::tests.index");
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

        return view("Theme::tests.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::tests.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(TestRequest $request)
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

        return view("Theme::tests.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Test\Requests\TestRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(TestRequest $request, $id)
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
