<?php

namespace Forum\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Forum\Models\Forum;
use Forum\Requests\ForumRequest;

class ForumController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resource = Forum::all();
        return view("Theme::forums.index")->with(compact('resource'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resource = Forum::findOrFail($id);

        return view("Theme::forums.show")->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::forums.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Forum\Requests\ForumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRquest $request)
    {
        $forum = new Forum();
        $forum->name = $request->input('name');
        $forum->code = $request->input('code');
        $forum->description = $request->input('description');

        $forum->save();

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
        $resource = Forum::findOrFail($id);

        return view("Theme::forums.edit")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Forum\Requests\ForumRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumRequest $request, $id)
    {
        $forum = Forum::findOrFail($id);
        $forum->name = $request->input('name');
        $forum->code = $request->input('code');
        $forum->description = $request->input('description');

        $forum->save();

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
        $forum = Forum::findOrFail($id);
        $forum->delete();

        return redirect()->route('forums.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $resources = Forum::onlyTrashed()->paginate();

        return view("Theme::forums.trash")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Forum\Requests\ForumRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $forum = Forum::onlyTrashed()->findOrFail($id);
        $forum->restore();

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Forum\Requests\ForumRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $forum = Forum::withTrashed()->findOrFail($id);
        $forum->forceDelete();

        return redirect()->route('forums.trash');
    }
}
