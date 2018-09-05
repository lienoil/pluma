<?php

namespace Assignment\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class AssignmentController extends GeneralController
{
    use Resources\ApiControllerTrait,
        Resources\PublicControllerTrait,
        Resources\SoftDeleteControllerTrait,
        Resources\AdminControllerTrait;
}
