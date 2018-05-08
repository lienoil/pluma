<?php

namespace User\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Role\Models\Role;
use User\Controllers\Resources\CanUploadToStorageTrait;
use User\Controllers\Resources\UserResourceAdminTrait;
use User\Controllers\Resources\UserResourceApiTrait;
use User\Controllers\Resources\UserResourceExportTrait;
use User\Controllers\Resources\UserResourceSoftDeleteTrait;
use User\Models\Detail;
use User\Models\User;
use User\Requests\UserRequest;

class UserController extends GeneralController
{
    use UserResourceAdminTrait,
        UserResourceApiTrait,
        UserResourceExportTrait,
        UserResourceSoftDeleteTrait;
}
