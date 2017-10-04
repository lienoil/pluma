<?php

namespace Lock\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Lock\Models\Lock;
use Lock\Requests\LockRequest;

class LockController extends AdminController
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

        return view("Theme::locks.index");
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

        return view("Theme::locks.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::locks.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Lock\Requests\LockRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LockRequest $request)
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

        return view("Theme::locks.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Lock\Requests\LockRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LockRequest $request, $id)
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

        return redirect()->route('locks.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::locks.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Lock\Requests\LockRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(LockRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Lock\Requests\LockRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(LockRequest $request, $id)
    {
        //

        return redirect()->route('locks.trash');
    }
}
