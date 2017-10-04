<?php

namespace Frontman\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Frontman\Models\Frontman;
use Frontman\Requests\QuestControllerRequest;

class QuestControllerController extends AdminController
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

        return view("Theme::questcontrollers.index");
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

        return view("Theme::questcontrollers.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::questcontrollers.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Frontman\Requests\QuestControllerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestControllerRequest $request)
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

        return view("Theme::questcontrollers.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Frontman\Requests\QuestControllerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestControllerRequest $request, $id)
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

        return redirect()->route('questcontrollers.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::questcontrollers.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Frontman\Requests\QuestControllerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(QuestControllerRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Frontman\Requests\QuestControllerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(QuestControllerRequest $request, $id)
    {
        //

        return redirect()->route('questcontrollers.trash');
    }
}
