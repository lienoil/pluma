<?php

namespace Course\Controllers;

use Course\Models\Course;
use Course\Models\User;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends AdminController
{
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
     * @param  int $user_id
     * @return \Illuminate\Auth\Access\Response
     */
    public function store(Request $request, $course_id)
    {
        $course = Course::findOrFail($course_id);
        $course->users()->attach(! empty($request->input('users')) ? $request->input('users') : []);

        foreach ($course->contents()->orderBy('sort')->get() as $sort => $content) {
            foreach ($request->input('users') as $user_id) {
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
        $course = Course::find($id);
        $courseUser = DB::table('course_user')
           ->whereIn('user_id', $request->input('user_id'))
           ->where('course_id', $course->id)
           ->update(['dropped_at' => date('Y-m-d H:i:s')]);

        return back();
    }

}
