<?php

namespace Assignment\Controllers;

use Assignment\Controllers\Resources\AssignmentAdminResourceTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class AssignmentController extends GeneralController
{
    use Resources\AssignmentAdminResourceTrait;
}
