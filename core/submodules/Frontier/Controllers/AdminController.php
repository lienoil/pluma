<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;
use Pluma\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Route;
use Pluma\Support\Auth\Access\Traits\AuthorizesRequests;
use Pluma\Support\Bus\Traits\DispatchesJobs;
use Pluma\Support\Validation\Traits\ValidatesRequests;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;//, Roleable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth.admin');
    }
}
