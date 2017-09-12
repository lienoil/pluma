<?php

namespace Course\Controllers;

use Course\Models\Course;
use Course\Requests\CourseRequest;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;

class CourseController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::courses.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::courses.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::courses.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Course\Requests\CourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo "<pre>";
        // dd($request->all());

        $course = new Course();
        $course->title = $request->input('title');
        $course->slug = $request->input('slug');
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->body = $request->input('body');
        $course->delta = $request->input('delta');
        $course->user()->associate(user());

        $request['lessons']->each(function ($input, $key) use ($course) {
            $lesson = new Lesson();
            $lesson->sort = $input->sort;
            $lesson->title = $input->title;
            $lesson->body = $input->body;
            $lesson->delta = $input->delta;

            // foreach ($input['contents'] as $input) {
            //     $content = new Content();
            //     $content->sort = $input['sort'];
            //     $content->title = $input['title'];
            //     $content->body = $input['body'];
            //     $content->delta = $input['delta'];
            //     $content->attachment = $input['attachment'];
            //     $content->delta = $input['delta'];
            //     $content->library()->associate(Library::find($input['library_id'])->first());
            //     $lesson->contents()->save($content);
            // }

            $course->lessons()->save($lesson);
        });

        $course->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::courses.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Course\Requests\CourseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('courses.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::courses.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Course\Requests\CourseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(CourseRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Course\Requests\CourseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(CourseRequest $request, $id)
    {
        //

        return redirect()->route('courses.trash');
    }
}
