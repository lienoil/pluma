<?php

namespace Assignment\Controllers;

use Assignment\Controllers\Resources\AssignmentResourceAdminTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class AssignmentController extends GeneralController
{
    use Resources\AssignmentResourceAdminTrait;
}
