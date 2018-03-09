<?php

namespace Course\Controllers;

use Course\Models\Course;
use Course\Models\Scormvar;
use Course\Models\User;
use Course\Support\Traits\StudentResourceSoftDeleteTrait;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends AdminController
{

    use StudentResourceSoftDeleteTrait;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $slug)
    {
        $resource = Course::whereSlug($slug)
            ->firstOrFail();

        $users = User::notEnrolledToCourse($resource->id)->get();

        return view("Theme::students.index")->with(compact('resource', 'users'));
    }


    /**
     * Stores the students into a resource (e.g. Course).
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $course_id
     * @return \Illuminate\Auth\Access\Response
     */
    public function store(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);
        $course->users()->attach(! empty($request->input('users')) ? $request->input('users') : []);

        foreach ($request->input('users') as $user_id) {
            foreach ($course->contents()->orderBy('sort')->get() as $sort => $content) {
                $content->users()->attach(User::find($user_id), [
                    'course_id' => $course->id,
                    'status' => $sort == 0 ? 'current' : 'pending',
                ]);
            }
        }

        return redirect()->route('courses.students', $course->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function drop(Request $request, $id)
    {
        // punyemas! two lines!, delete nyo to pagnabasa nyo
        $course = Course::find($id);
        $course->users()->detach($request->input('user_id'));

        // Then remove content_user
        foreach ($request->input('user_id') as $id) {
            $user = User::find($id);
            $user->contents()->detach();

            // Then remove scormvars
            Scormvar::where('course_id', $course->id)->where('user_id', $id)->delete();
        }
        return back();
    }
}
