<?php

namespace Widget\Controllers;

use Widget\Models\Widget;
use Widget\Requests\WidgetRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class WidgetController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $widgets = Widget::bundled();

        return view("Theme::widgets.index");
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

        return view("Theme::widgets.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::widgets.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Widget\Requests\WidgetRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(WidgetRequest $request)
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

        return view("Theme::widgets.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Widget\Requests\WidgetRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(WidgetRequest $request, $id)
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
