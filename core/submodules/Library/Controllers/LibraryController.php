<?php

namespace Library\Controllers;

use Catalogue\Models\Catalogue;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Library\Models\Library;
use Library\Requests\LibraryRequest;

class LibraryController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Library::all();
        $catalogues = Catalogue::all();

        return view("Theme::library.index")->with(compact('resources', 'catalogues'));
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

        return view("Theme::library.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::library.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibraryRequest $request)
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

        return view("Theme::library.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LibraryRequest $request, $id)
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

        return redirect()->route('library.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::library.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(LibraryRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(LibraryRequest $request, $id)
    {
        //

        return redirect()->route('library.trash');
    }
}
