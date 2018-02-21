<?php

namespace Pluma\API\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Pluma\Support\Auth\Access\Traits\AuthorizesRequests;
use Pluma\Support\Bus\Traits\DispatchesJobs;
use Pluma\Support\Validation\Traits\ValidatesRequests;

class APIController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $successResponse = [
        'context' => 'success',
        'type' => 'success',
        'message' => 'Success',
        'text' => 'Action successfully done',
    ];

    protected $errorResponse = [
        'context' => 'error',
        'type' => 'danger',
        'message' => 'Error',
        'text' => 'Error on last action executed',
    ];

    /**
     * Number of data to be process at a given time.
     *
     * @var integer
     */
    protected $chunk = 10;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['api', 'cors']);
    }
}
