<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Role\Models\Grant;
use Role\Models\Permission;
use Role\Requests\GrantRequest;

class GrantController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Grant::paginate();
        $permissions = Permission::pluck('code', 'id');

        return view("Role::grants.index")->with(compact('resources', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::pluck('code', 'id');

        return view("Role::grants.create")->with(compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Role\Requests\GrantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grant = new Grant();
        $grant->name = $request->input('name');
        $grant->code = $request->input('code');
        $grant->description = $request->input('description');
        $grant->save();

        $grant->permissions()->attach($request->input('permissions'));

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = Grant::findOrFail($id);
        $permissions = Permission::pluck('code', 'id');

        return view("Role::grants.edit")->with(compact('resource', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $grant = Grant::findOrFail($id);
        $grant->name = $request->input('name');
        $grant->code = $request->input('code');
        $grant->description = $request->input('description');
        $grant->save();

        $grant->permissions()->sync($request->input('permissions'));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $grant = Grant::findOrFail($id);
        $grant->delete();

        return back();
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        //
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
