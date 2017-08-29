<?php

namespace Quest\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Quest\Models\Quest;

class CourseController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::courses.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::courses.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::courses.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Quest\Requests\CourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        //

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::courses.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Quest\Requests\CourseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('courses.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::courses.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Quest\Requests\CourseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(CourseRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Quest\Requests\CourseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(CourseRequest $request, $id)
    {
        //

        return redirect()->route('courses.trash');
    }
}
