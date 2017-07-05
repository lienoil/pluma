<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Role::roles.index");
    }
}
