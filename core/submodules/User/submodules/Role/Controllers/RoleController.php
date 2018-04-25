<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Role\Models\Role;
use Role\Requests\RoleRequest;

class RoleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Role::paginate();
        $trashed = Role::onlyTrashed()->count();
        $grants = collect([]);

        return view("Theme::roles.index")->with(compact('resources', 'grants', 'trashed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Role\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = new Role();
        $role->name = $request->input('name');
        $role->code = $request->input('code');
        $role->description = $request->input('description');
        $role->alias = $request->input('alias');
        $role->save();
        $role->grants()->attach($request->input('grants'));

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
        $resource = Role::findOrFail($id);

        return view("Theme::roles.show")->with(compact('resource'));
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
        $resource = Role::findOrFail($id);
        $grants = Grant::pluck('name', 'id');

        return view("Theme::roles.edit")->with(compact('resource', 'grants'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Role\Requests\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->code = $request->input('code');
        $role->description = $request->input('description');
        $role->alias = $request->input('alias');
        $role->save();
        $role->grants()->sync($request->input('grants'));

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
        $role = Role::findOrFail($id);

        if (! in_array($role->code, config('auth.rootroles', []))) {
            $role->delete();
        }

        return redirect()->route('roles.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $resources = Role::onlyTrashed()->paginate();

        return view("Theme::roles.trashed")->with(compact('resources'));
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
        $role = Role::onlyTrashed()->findOrFail($id);
        $role->restore();

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
        $role = Role::withTrashed()->findOrFail($id);
        $role->forceDelete();

        return redirect()->route('roles.trashed');
    }
}
