<?php

namespace Course\Controllers\Resources;

use Course\Models\Course;
use Course\Models\Lesson;
use Illuminate\Http\Request;

trait CourseResourceAdminTrait
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Course::search($request->all())->paginate();


        return view('Course::courses.index')->with(compact('resources'));
    }

    /**
     * Show a given resource.
     *
     * @param  Request $request
     * @param  int     $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Course::findOrFail($id);

        return view('Course::courses.show')->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $resource = Course::first();
        app()->singleton(\Illuminate\Contracts\Console\Kernel::class, \Blacksmith\Console\Kernel::class);
        \Blacksmith\Support\Facades\Blacksmith::call('db:truncate', ['tables' => 'lessons,courses,lessonstree']);

        $course = factory(Course::class)->create();
        $lessons = factory(Lesson::class, 3)->create(['course_id' => $course->id]);
        foreach ($lessons as $lesson) {
            $lesson->course()->associate($course);
            $lesson->adjaceables()->addAsRoot();
            $chapters = factory(Lesson::class, 3)->create(['course_id' => $course->id]);
            collect($chapters)->each(function ($chapter) use ($course, $lesson) {
                $chapter->course()->associate($course);
                $lesson->adjaceables()->attach($chapter);
            });
        }
        $resource = Course::first();

        $lessons = $resource->children;
        foreach ($lessons as $lesson) {
            $lesson->adjaceables()->children();
        }

        return view('Course::courses.create')->with(compact('resource'));
    }
}
