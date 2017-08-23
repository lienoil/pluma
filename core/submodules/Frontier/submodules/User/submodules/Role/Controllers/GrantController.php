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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Grant::paginate();
        $permissions = Permission::select(['code', 'name', 'id', 'description'])->get();

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
    public function store(GrantRequest $request)
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
     * @param  \Illuminate\Http\Request $request
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
     * @param  \Role\Requests\GrantRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GrantRequest $request, $id)
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
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Grant::findOrFail($id);

        return view("Role::grants.show")->with(compact('resource'));
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
        $grant = Grant::findOrFail($id);
        $grant->delete();

        return redirect()->route('grants.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $resources = Grant::onlyTrashed()->paginate();

        return view("Role::grants.trash")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $grant = Grant::onlyTrashed()->findOrFail($id);
        $grant->restore();

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $grant = Grant::withTrashed()->findOrFail($id);
        $grant->forceDelete();

        return redirect()->route('grants.trash');
    }

    /**
     * Copy the resource as a new resource.
     * @param  Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clone(Request $request, $id)
    {
        $grant = Grant::findOrFail($id);
        $grant->code = "{$grant->code}-clone-$id";
        Grant::create($grant->toArray());

        return back();
    }
}
