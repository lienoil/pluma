<?php

namespace Course\Controllers;

use Course\Models\Course;
use Course\Requests\CourseRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class CourseController extends GeneralController
{
    use Resources\CourseResourceAdminTrait,
        Resources\CourseResourceApiTrait,
        // Resources\CourseResourceSoftDeletesTrait,
        Resources\CourseResourcePublicTrait;
}
