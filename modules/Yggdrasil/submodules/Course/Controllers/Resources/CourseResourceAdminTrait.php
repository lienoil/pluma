<?php

namespace Course\Controllers\Resources;

use Course\Models\Course;
use Illuminate\Http\Request;

trait CourseResourceAdminTrait
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Course::search($request->all())->paginate();

        return view('Course::courses.index')->with(compact('resources'));
    }

    /**
     * Show a given resource.
     *
     * @param  Request $request
     * @param  int     $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Course::findOrFail($id);

        return view('Course::courses.show')->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        return view('Course::courses.create');
    }
}
