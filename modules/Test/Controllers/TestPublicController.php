<?php

namespace Test\Controllers;

use Frontier\Controllers\PublicController;
use Illuminate\Http\Request;

class TestPublicController extends PublicController
{
    public function index(Request $request)
    {
        return view("Test::public.index");
    }
}
