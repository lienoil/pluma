<?php

namespace Pluma\API\Controllers;

// use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class APIController extends BaseController
{
    // use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $successResponse = [
        'code' => 'success',
        'type' => 'success',
        'message' => 'Success',
    ];

    protected $errorResponse = [
        'code' => 'error',
        'type' => 'danger',
        'message' => 'Error',
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['api']);
    }
}
