<?php

namespace Profile\Controllers;

use Profile\Models\Profile;
use Profile\Requests\CredentialRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class CredentialController extends GeneralController
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

        return view("Theme::credentials.index");
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

        return view("Theme::credentials.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::credentials.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Profile\Requests\CredentialRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(CredentialRequest $request)
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

        return view("Theme::credentials.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Profile\Requests\CredentialRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(CredentialRequest $request, $id)
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
