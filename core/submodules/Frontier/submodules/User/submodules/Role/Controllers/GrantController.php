<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Role\Models\Permission;

class GrantController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view("Role::grant.create")->with(compact('permissions'));
    }
}
