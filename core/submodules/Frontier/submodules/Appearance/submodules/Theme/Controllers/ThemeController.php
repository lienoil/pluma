<?php

namespace Theme\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Theme\Models\Theme;
use Theme\Requests\ThemeRequest;

class ThemeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active = Theme::theme(settings('active_theme', 'default'));
        $resources = Theme::themes(false);

        return view("Theme::settings.themes")->with(compact('resources', 'active'));
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

        return view("Theme::themes.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::themes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Theme\Requests\ThemeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ThemeRequest $request)
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

        return view("Theme::themes.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Theme\Requests\ThemeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeRequest $request, $id)
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

        return redirect()->route('themes.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::themes.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Theme\Requests\ThemeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(ThemeRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Theme\Requests\ThemeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(ThemeRequest $request, $id)
    {
        //

        return redirect()->route('themes.trash');
    }
}
