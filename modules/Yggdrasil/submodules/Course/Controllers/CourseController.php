<?php

namespace Course\Controllers;

use Assignment\Models\Assignment;
use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Content\Models\Content;
use Course\Models\Course;
use Course\Requests\CourseRequest;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;
use Library\Models\Library;

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
        $courses = Course::all();

        return view("Theme::courses.index")->with(compact('courses'));
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
        $resource = Course::whereSlug($slug)->firstOrFail();

        return view("Theme::courses.show")->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catalogues = Catalogue::mediabox();
        $categories = Category::all();

        return view("Theme::courses.create")->with(compact('catalogues', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Course\Requests\CourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        $course = new Course();
        $course->title = $request->input('title');
        $course->slug = $request->input('slug');
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->body = $request->input('body');
        $course->delta = $request->input('delta');
        $course->category()->associate(Category::find($request->input('category_id')));
        $course->user()->associate(user());
        $course->save();

        // Lessons
        collect(json_decode(json_encode($request['lessons'])))->each(function ($input, $key) use ($course) {
            $lesson = new Lesson();
            $lesson->sort = $input->sort;
            $lesson->title = $input->title;
            $lesson->body = $input->body;
            $lesson->delta = $input->delta;
            $lesson->course()->associate($course);
            if (! empty($input->assignment->title)) {
                $lesson->assignment()->associate(Assignment::create((array) $input->assignment));
            }
            $lesson->save();

            // Contents
            if (isset($input->contents)) {
                foreach ($input->contents as $input) {
                    $content = new Content();
                    $content->sort = $input->sort;
                    $content->title = $input->title;
                    $content->body = $input->body;
                    $content->delta = $input->delta;
                    // $content->attachment = $input->attachment;
                    $content->lesson()->associate($lesson);
                    $content->library()->associate(Library::find($input->library_id));
                    $content->save();
                }
            }
        });

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
        $resource = Course::lockForUpdate()->findOrFail($id);

        return view("Theme::courses.edit")->with(compact('resource'));
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
        $course = Course::findOrFail($id);
        dd($request->all());

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
