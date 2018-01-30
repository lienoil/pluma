<?php

namespace Submission\Controllers;

use Submission\Models\Submission;
use Submission\Requests\SubmissionRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class SubmissionController extends GeneralController
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

        return view("Theme::submissions.index");
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

        return view("Theme::submissions.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::submissions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Submission\Requests\SubmissionRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(SubmissionRequest $request)
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

        return view("Theme::submissions.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Submission\Requests\SubmissionRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(SubmissionRequest $request, $id)
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
