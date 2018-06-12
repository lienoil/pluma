<?php

namespace Timesheet\Controllers;

use Timesheet\Models\Timesheet;
use Timesheet\Requests\TimesheetRequest;
use Timesheet\Controllers\Resources\TimesheetResourceAdminTrait;
use Timesheet\Controllers\Resources\TimesheetResourceApiTrait;
use Timesheet\Controllers\Resources\TimesheetResourceSoftDeletesTrait;
use Timesheet\Controllers\Resources\TimesheetResourcePublicTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class TimesheetController extends GeneralController
{
    use TimesheetResourceAdminTrait;
}
