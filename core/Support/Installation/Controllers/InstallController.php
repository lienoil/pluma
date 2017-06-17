<?php

namespace Pluma\Support\Installation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InstallController extends Controller
{
    public function welcome(Request $request)
    {
        return view("Pluma::welcome.welcome");
        dd("welcome");
    }
}
