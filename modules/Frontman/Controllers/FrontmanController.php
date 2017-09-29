<?php

namespace Frontman\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Frontman\Models\Frontman;
use Frontman\Requests\FrontmanRequest;

class FrontmanController extends AdminController
{
    /**
     * Funnel all GET request
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        //

        return view("Theme::frontman.main");
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

        return view("Theme::frontmen.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::frontmen.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Frontman\Requests\FrontmanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FrontmanRequest $request)
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

        return view("Theme::frontmen.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Frontman\Requests\FrontmanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FrontmanRequest $request, $id)
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

        return redirect()->route('frontmen.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::frontmen.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Frontman\Requests\FrontmanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(FrontmanRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Frontman\Requests\FrontmanRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(FrontmanRequest $request, $id)
    {
        //

        return redirect()->route('frontmen.trash');
    }
}
