<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;
use Role\Models\Permission;

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
}
