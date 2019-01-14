<?php

namespace Pluma\Controllers;

use Frontier\Support\View\DefaultViewsForAdmin;
use Illuminate\Routing\Controller as BaseController;
use Pluma\Support\Auth\Access\Traits\AuthorizesRequests;
use Pluma\Support\Bus\Traits\DispatchesJobs;
use Pluma\Support\Validation\Traits\ValidatesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, DefaultViewsForAdmin;

    /**
     * The repository instance.
     *
     * @var \Pluma\Support\Repository\Repository
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Retrieve the Repository instance.
     *
     * @return Pluma\Support\Repository\Repository
     */
    public function repository()
    {
        return $this->repository;
    }
}
