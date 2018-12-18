<?php

namespace Page\Controllers;

use Frontier\Controllers\GeneralController;
use Page\Repositories\PageRepository;

class PageController extends GeneralController
{
    use Resources\PageResourceAdminTrait,
        Resources\PageResourceApiTrait,
        Resources\PageResourceOwnedTrait,
        Resources\PageResourcePublicTrait,
        Resources\PageResourceSoftDeleteTrait;

    public function __construct()
    {
        parent::__construct();

        $this->repository = new PageRepository();
    }
}
