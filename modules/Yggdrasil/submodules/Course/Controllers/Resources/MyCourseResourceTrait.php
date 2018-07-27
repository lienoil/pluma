<?php

namespace Course\Controllers\Resources;

use Course\Models\Student;
use Illuminate\Http\Request;

trait MyCourseResourceTrait
{
    /**
     * Retrieve list of all resources
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
     * View list of all resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function FunctionName($value='')
    {
        $resources = Course::onlyBookmarkedBy(user())
                           ->search($request->all())
                           ->paginate();

        if ($request->ajax()) {
            return response()->json($resources);
        }

        return view("Theme::courses.bookmarked")->with(compact('resources'));
    }

    /**
     * Request for the given resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function request(Request $request, $id)
    {
       $course = Course::findOrFail($id);
       $student = User::find($request->input('user_id'));

       // Enroll
       $course->users()->attach($student);
       foreach ($course->contents()->orderBy('sort')->get() as $sort => $content) {
            $content->users()->attach($student, [
                'course_id' => $course->id,
                'status' => $sort == 0 ? 'current' : 'pending',
            ]);
       }

       // Send Email
       # to student
       Mail::to($student->email)
           ->send(new NewCourseRequest($course, $student));
       #to trainer
       Mail::to($course->user->email)
           ->cc(settings('site_email'))
           ->send(new NewCourseRequest($course, $student));

       return back();
    }
}
