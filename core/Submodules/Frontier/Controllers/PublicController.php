<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;

class PublicController
{
    public function index(Request $request)
    {
        return dd($request);
    }

    public function show($slug = null)
    {
        return "$slug";
    }
}
