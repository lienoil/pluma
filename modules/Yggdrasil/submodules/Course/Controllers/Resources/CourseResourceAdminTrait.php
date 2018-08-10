<?php

namespace Course\Controllers\Resources;

use Category\Models\Category;
use Course\Models\Course;
use Course\Models\Lesson;
use Course\Requests\CourseRequest;
use Illuminate\Http\Request;
use User\Models\User;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param Course\Requests\CourseRequest $request
     * @return Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        //dd($request->all());
        $course = new Course();
        $course->title = $request->input('title');
        $course->slug = str_slug($request->input('slug'));
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->backdrop = $request->input('backdrop');
        $course->body = $request->input('body');
        // $course->user()->save(User::find($request->user)); //or $request->user() or $request->input('user_id');
        // $course->category()->save(Category::find($request->input('category_id')));
        $course->save();

        // Chapters
        // collect($request->input('lessons'))->each(function ($lesson) use ($course) {
        //     $chapter = new Lesson();
        //     $chapter->title = $lesson['title'];
        //     $chapter->slug = str_slug($lesson['slug']);
        //     $chapter->code = $lesson['code'];
        //     $chapter->feature = $lesson['feature'];
        //     $chapter->body = $lesson['body'];
        //     $chapter->sort = $lesson['sort'];
        //     $chapter->course()->save($course); // or attach
        //     $chapter->save();

        //     $chapter->adjaceables()->addAsRoot();

        //     // Parts
        //     $parts = $lesson['parts'];
        //     collect($parts)->each(function($part) use ($chapter) {
        //         $content =new Lesson();
        //         // $content->title = $part['title']
        //         $content->save();
        //         $chapter->adjaceables()->attach($content);
        //     });
        // });
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
     * Show the form editing the specified resource.
     *
     * @param Illuminate\Http\Request $request
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = Course::findOrFail($id);
        return view("Course::courses.edit")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Course\Requests\CourseRequest $request
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->title = $request->input('title');
        $course->slug = $request->input('slug');
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->backdrop = $request->input('backdrop');
        $course->body = $request->input('body');
        $course->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index');
    }

}
