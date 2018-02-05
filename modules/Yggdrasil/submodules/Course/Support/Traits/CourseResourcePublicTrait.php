<?php

namespace Course\Support\Traits;

use Illuminate\Http\Request;
use Menu\Models\Menu;
use Course\Models\Course;

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

    /**
     * Try to retrieve the resource of the given slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $code
     * @return Illuminate\Http\Response
     */
    public function single(Request $request, $code = null)
    {
        $resource = Course::whereSlug($code)
                          ->orWhere('code', $code)
                          ->firstOrFail();

        // dd($resource->comments);
        return view("Theme::courses.single")->with(compact('resource'));
    }
}
