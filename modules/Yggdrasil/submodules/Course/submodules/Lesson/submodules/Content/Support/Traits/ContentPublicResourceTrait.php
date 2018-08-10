<?php

namespace Content\Support\Traits;

use Content\Models\Content;
use Course\Models\Course;
use Illuminate\Http\Request;

trait ContentPublicResourceTrait
{
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function single(Request $request, $course, $lesson, $id)
    {
        $resource = Content::with('lesson.course')->find($id);
        $course = Course::with('lessons')->whereSlug($course)->first();

        return view("Theme::courses.single")->with(compact('resource', 'course'));
    }
}
