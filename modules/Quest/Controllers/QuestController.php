<?php

namespace Quest\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Quest\Models\Quest;
use Quest\Requests\QuestRequest;

class QuestController extends AdminController
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

        return view("Theme::quests.index");
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

        return view("Theme::quests.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::quests.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Quest\Requests\QuestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestRequest $request)
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

        return view("Theme::quests.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Quest\Requests\QuestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestRequest $request, $id)
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

        return redirect()->route('quests.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::quests.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Quest\Requests\QuestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(QuestRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Quest\Requests\QuestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(QuestRequest $request, $id)
    {
        //

        return redirect()->route('quests.trash');
    }
}
