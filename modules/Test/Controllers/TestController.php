<?php

namespace Test\Controllers;

use Catalogue\Models\Catalogue;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Library\Models\Library;
use Test\Models\Test;
use Test\Requests\TestRequest;

class TestController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $catalogues = Catalogue::all();
        $array[] = array(
            'count' => Library::count(),
            'name' => 'All',
            'icon' => 'perm_media',
            'url' => route('api.library.all')
        );

        foreach ($catalogues as $i => $catalogue) {
            $array[$i+1]['count'] = $catalogue->libraries->count();
            $array[$i+1]['name'] = $catalogue->name;
            $array[$i+1]['url'] = route('api.library.catalogue', [$catalogue->id]);
            $array[$i+1]['icon'] = $catalogue->icon;
        }

        $catalogues = $array;

        return view("Theme::tests.index")->with(compact('catalogues'));
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

        return view("Theme::tests.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::tests.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
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

        return view("Theme::tests.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, $id)
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

        return redirect()->route('tests.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::tests.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(TestRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(TestRequest $request, $id)
    {
        //

        return redirect()->route('tests.trash');
    }
}
