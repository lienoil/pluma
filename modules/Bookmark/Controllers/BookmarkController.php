<?php

namespace Bookmark\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Bookmark\Models\Bookmark;
use Bookmark\Requests\BookmarkRequest;

class BookmarkController extends AdminController
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

        return view("Theme::bookmarks.index");
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

        return view("Theme::bookmarks.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::bookmarks.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Bookmark\Requests\BookmarkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookmarkRequest $request)
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

        return view("Theme::bookmarks.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Bookmark\Requests\BookmarkRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookmarkRequest $request, $id)
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

        return redirect()->route('bookmarks.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::bookmarks.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Bookmark\Requests\BookmarkRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(BookmarkRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Bookmark\Requests\BookmarkRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(BookmarkRequest $request, $id)
    {
        //

        return redirect()->route('bookmarks.trash');
    }
}
