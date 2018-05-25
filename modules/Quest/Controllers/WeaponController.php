<?php

namespace Quest\Controllers;

use Quest\Models\Quest;
use Quest\Requests\WeaponRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class WeaponController extends GeneralController
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

        return view("Theme::weapons.index");
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

        return view("Theme::weapons.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::weapons.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Quest\Requests\WeaponRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(WeaponRequest $request)
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

        return view("Theme::weapons.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Quest\Requests\WeaponRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(WeaponRequest $request, $id)
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
