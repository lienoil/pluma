<?php

namespace Role\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Role\Models\Role;
use Role\Repositories\RoleRepository;
use Role\Requests\RoleRequest;

class RoleController extends AdminController
{
    use Resources\RoleAdminTrait,
        Resources\RoleImportTrait,
        Resources\RoleSoftDeletesTrait;

    /**
     * Inject the resource model to the repository instance.
     *
     * @param \Pluma\Support\Repository\Repository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        parent::__construct();

        $this->repository = $repository;
    }
}
