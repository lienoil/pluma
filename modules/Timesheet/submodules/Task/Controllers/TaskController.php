<?php

namespace Task\Controllers;

use Task\Models\Task;
use Task\Requests\TaskRequest;
use Task\Controllers\Resources\TaskResourceAdminTrait;
use Task\Controllers\Resources\TaskResourceApiTrait;
use Task\Controllers\Resources\TaskResourceSoftDeletesTrait;
use Task\Controllers\Resources\TaskResourcePublicTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class TaskController extends GeneralController
{
    use TaskResourceAdminTrait,
        TaskResourceApiTrait,
        TaskResourceSoftDeletesTrait,
        TaskResourcePublicTrait;
}
