<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;
use Role\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Permission::paginate();

        return view("Role::permissions.index")->with(compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Role::permissions.create");
    }
}
