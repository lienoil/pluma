<?php

namespace Course\Controllers\Resources;

use Course\Models\Course;
use Illuminate\Http\Request;

trait CourseResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Course::search($request->all())->paginate();

        return view("Theme::courses.all")->with(compact('resources'));
    }
}
