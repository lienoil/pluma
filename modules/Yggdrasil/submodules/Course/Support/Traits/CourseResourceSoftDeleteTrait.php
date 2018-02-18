<?php

namespace Course\Support\Traits;

use Course\Models\Course;
use Illuminate\Http\Request;

trait CourseResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Course::onlyTrashed()
                           ->search($request->all())
                           ->paginate();

        return view("Theme::courses.trashed")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $courses = Course::onlyTrashed()
                         ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                         ->get();

        foreach ($courses as $course) {
            $course->restore();
        }

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $courses = Course::onlyTrashed()
                         ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                         ->get();

        foreach ($courses as $course) {
            $course->forceDelete();
        }

        return back();
    }
}
