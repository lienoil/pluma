<?php

namespace Course\Controllers;

use Course\Models\Course;
use Course\Requests\CourseRequest;
use Course\Controllers\Resources\CourseResourceAdminTrait;
use Course\Controllers\Resources\CourseResourceApiTrait;
use Course\Controllers\Resources\CourseResourceSoftDeletesTrait;
use Course\Controllers\Resources\CourseResourcePublicTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class CourseController extends GeneralController
{
    use CourseResourceAdminTrait,
        // CourseResourceApiTrait,
        // CourseResourceSoftDeletesTrait,
        CourseResourcePublicTrait;
}
