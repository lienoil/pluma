<?php

namespace Menu\Controllers\Resources;

use Illuminate\Http\Request;
use Menu\Requests\MenuRequest;

trait MenuResourceAdminTrait
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locations = $this->repository->model()->locations();
        $pages = $this->repository->pages();
        $resource = $this->repository->location($request->get('code'));

        return view('Theme::menus.index')->with(compact('locations', 'resource', 'pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $code)
    {
        $resource = $this->repository->location($code);
        $repository = $this->repository;

        return view('Theme::menus.edit')->with(compact('resource', 'repository'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Menu\Requests\MenuRequest  $request
     * @param  string    $code
     * @return Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $code)
    {
        $this->repository->update($request->all(), $code);

        return back();
    }
}
