<?php

namespace Pluma\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Pluma\Support\Auth\Access\Traits\AuthorizesRequests;
use Pluma\Support\Bus\Traits\DispatchesJobs;
use Pluma\Support\Validation\Traits\ValidatesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * the default resource count per page.
     *
     * @var integer
     */
    protected $paginationCount = 15;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setPaginationCount(config('settings.pagination_count', $this->paginationCount));

        $this->middleware('web');
    }

    /**
     * Set the global pagination count.
     *
     * @param integer $count
     */
    private function setPaginationCount($count)
    {
        $this->paginationCount = $count;
    }

    /**
     * Gets the global pagination count.
     *
     * @return integer
     */
    public function getPaginationCount()
    {
        return $this->paginationCount;
    }

    /**
     * Alias of `getPaginationCount`.
     *
     * @return integer
     */
    public function paginationCount()
    {
        return $this->paginationCount;
    }
}
