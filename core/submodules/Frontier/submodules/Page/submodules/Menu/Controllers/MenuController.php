<?php

namespace Menu\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Menu\Models\Menu;
use Menu\Requests\MenuRequest;

class MenuController extends AdminController
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

        return view("Theme::menus.index");
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

        return view("Theme::menus.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::menus.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Menu\Requests\MenuRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
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

        return view("Theme::menus.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Menu\Requests\MenuRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
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

        return redirect()->route('menus.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::menus.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Menu\Requests\MenuRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(MenuRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Menu\Requests\MenuRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(MenuRequest $request, $id)
    {
        //

        return redirect()->route('menus.trash');
    }
}
