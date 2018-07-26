<?php

namespace Course\Controllers;

use Course\Controllers\Resources\CourseResourceAdminTrait;
use Course\Controllers\Resources\CourseResourceApiTrait;
use Course\Controllers\Resources\CourseResourcePublicTrait;
use Course\Models\Course;
use Course\Requests\CourseRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class CourseController extends GeneralController
{
    use Resources\CourseResourceAdminTrait,
        Resources\CourseResourceApiTrait,
        // Resources\CourseResourceSoftDeletesTrait,
        Resources\CourseResourcePublicTrait,
        Resources\MyCourseResourceTrait;

}
