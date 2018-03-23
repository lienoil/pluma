<?php

namespace Octocat\Controllers;

use Octocat\Models\Octocat;
use Octocat\Requests\OctocatRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class OctocatController extends GeneralController
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

        return view("Theme::octocats.index");
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

        return view("Theme::octocats.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::octocats.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Octocat\Requests\OctocatRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(OctocatRequest $request)
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

        return view("Theme::octocats.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Octocat\Requests\OctocatRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(OctocatRequest $request, $id)
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
