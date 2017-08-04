<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;
use Role\Models\Grant;
use Role\Models\Permission;
use Role\Requests\GrantRequest;

class GrantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::pluck('code', 'id');

        return view("Role::grants.index")->with(compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view("Role::grants.create")->with(compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
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
        # code...
    }
}
