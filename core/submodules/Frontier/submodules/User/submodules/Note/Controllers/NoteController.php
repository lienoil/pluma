<?php

namespace Note\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Note\Models\Note;
use Note\Requests\NoteRequest;
use Note\Support\Traits\NoteResourceApiTrait;
use User\Models\User;

class NoteController extends GeneralController
{
    use NoteResourceApiTrait;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Note::search($request->all())->paginate();

        return view("Note::notes.index")->with(compact('resources'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string  $handlename
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $handlename)
    {
        $resource = User::whereUsername($handlename)->firstOrFail();

        return view("Note::notes.show")->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Note::notes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Note\Requests\NoteRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
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

        return view("Note::notes.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Note\Requests\NoteRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(NoteRequest $request, $id)
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
