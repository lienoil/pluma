<?php

namespace Course\Support\Traits;

use Course\Models\Course;
use Course\Models\Student;
use Illuminate\Http\Request;

trait MyCourseResourceTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function current(Request $request)
    {
        $resources = Student::findOrFail(user()->id)
                            ->courses()
                            ->search($request->all())
                            ->paginate();

        if ($request->ajax()) {
            return response()->json($resources);
        }

        return view("Theme::courses.my")->with(compact('resources'));
    }

    /**
     * View list of bookmarked courses.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function bookmarked(Request $request)
    {
        $resources = Course::onlyBookmarkedBy(user())
                           ->search($request->all())
                           ->paginate();

        if ($request->ajax()) {
            return response()->json($resources);
        }

        return view("Theme::courses.bookmarked")->with(compact('resources'));
    }
}
