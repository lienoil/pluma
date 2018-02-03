<?php

namespace Course\Controllers;

use Course\Models\Course;
use Course\Models\User as Student;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;

class CourseProfileController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the detail form of the course to be enrolled.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $handle)
    {
        $resource = Student::whereUsername($handle)->firstOrFail();
        $resources = $resource->courses;

        return view("Course::courses.profile")->with(compact('resource', 'resources'));
    }
}
