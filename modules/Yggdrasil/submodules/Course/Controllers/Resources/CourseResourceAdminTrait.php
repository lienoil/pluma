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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $resource = Course::slugOrFail($slug);

        return view('Course::courses.show')->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // // $resource = Course::first();
        // app()->singleton(\Illuminate\Contracts\Console\Kernel::class, \Blacksmith\Console\Kernel::class);
        // \Blacksmith\Support\Facades\Blacksmith::call('db:truncate', ['tables' => 'lessons,courses,lessonstree']);

        // $course = factory(Course::class)->create();
        // $lessons = factory(Lesson::class, 3)->create(['course_id' => $course->id]);
        // foreach ($lessons as $lesson) {
        //     $lesson->course()->associate($course);
        //     $lesson->adjaceables()->attach($lesson);
        //     $chapters = factory(Lesson::class, 3)->create(['course_id' => $course->id]);
        //     collect($chapters)->each(function ($chapter) use ($course, $lesson) {
        //         $chapter->course()->associate($course);
        //         $lesson->adjaceables()->attach($chapter);

        //     });
        // }

        // $chapter = null;

        // // $chapter->adjaceables()->detach();
        // // (Lesson::find(2))->adjaceables()->attach($chapter);
        // $chapter = Lesson::find(8);
        // $topics = factory(Lesson::class, 2)->create(['course_id' => $course->id]);
        // collect($topics)->each(function ($topic) use ($course, $chapter) {
        //     $topic->course()->associate($course);
        //     $chapter->adjaceables()->attach($topic);
        // });


        $resource = Course::first();
        return view('Course::courses.create')->with(compact('resource'));
    }
}
