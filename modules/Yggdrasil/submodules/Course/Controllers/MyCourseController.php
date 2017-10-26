<?php

namespace Course\Controllers;

use Assignment\Models\Assignment;
use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Content\Models\Content;
use Course\Models\Course;
use Course\Models\User;
use Course\Requests\CourseRequest;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;
use Library\Models\Library;

class MyCourseController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * Use the Course\Models\User instead
         * of the default User\Models\User.
         * In this way we have access to the course_user relationship.
         *
         * @var \Course\Models\User $user
         */
        $user = User::find(user()->id);
        $resources = $user->courses;

        // dd($resources[0]->bookmarked);

        return view("Theme::my.index")->with(compact('resources'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $resource = Course::whereSlug($slug)
            ->with('lessons.contents')
            ->firstOrFail();

        return view("Theme::courses.show")->with(compact('resource'));
    }
}
