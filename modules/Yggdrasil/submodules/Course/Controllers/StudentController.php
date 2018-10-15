<?php

namespace Course\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;

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
            ->firstorFail();

        $users = User::notEnrolledToCourse($resource->id->get());

        return view("Theme::students.index")->with(compact('resource', 'users'));
    }

    /**
     * Stores the students into a resource (e.g Course).
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
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function drop(Request $request, $id)
    {
        $course = Course::find($id);
        $course->contents()->detach();

        foreach ($request->input('user_id') as $id) {
            $user = User::find($id);
            $user->contents()->detach();

            Scormvar::where('course_id', $course->id)->where('user_id', $id)->delete();
        }

        session()->flash('title', "Success");
        session()->flash('message', "Student successfully droped");
        session()->flash('type', 'success');

        return redirect()->route('courses.students', $course->slug);
    }

    /**
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Course::destroy($request->has('id') ? $request->input('id') : $id);

        return redirect()->route('students.index');
    }

}
