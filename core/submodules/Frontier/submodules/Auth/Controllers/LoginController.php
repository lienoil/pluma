<?php

namespace Admin\Auth\Controllers;

use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function getLoginForm()
    {
        return view("Auth::auth.login");
    }
}
