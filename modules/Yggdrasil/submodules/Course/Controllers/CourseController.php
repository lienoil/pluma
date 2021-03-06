<?php

namespace Course\Controllers;

use Assignment\Models\Assignment;
use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Comment\Models\Comment;
use Comment\Requests\CommentRequest;
use Content\Models\Content;
use Course\Models\Course;
use Course\Models\User;
use Course\Requests\CourseRequest;
use Course\Support\Traits\CourseResourceApiTrait;
use Course\Support\Traits\CourseResourcePublicTrait;
use Course\Support\Traits\CourseResourceSoftDeleteTrait;
use Course\Support\Traits\MyCourseResourceTrait;
use Form\Models\Form;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;
use Library\Models\Library;

class CourseController extends GeneralController
{
    use CourseResourceApiTrait,
        CourseResourcePublicTrait,
        CourseResourceSoftDeleteTrait,
        MyCourseResourceTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth.admin')->only(array_merge($this->methodsAdmin, ['current', 'bookmarked']));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Course::all();

        return view("Theme::courses.index")->with(compact('resources'));
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catalogues = Catalogue::mediabox();
        $media = Catalogue::mediabox([[
            'count' => Form::type('courses')->count(),
            'name' => 'Forms',
            'icon' => 'perm_media',
            'url' => route('api.forms.media', ['type' => 'courses'])
        ]]);
        $categories = Category::all();
        $surveys = Form::type('courses')->get();

        return view("Theme::courses.create")->with(compact('catalogues', 'categories', 'media', 'surveys'));
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
        $course->backdrop = $request->input('backdrop');
        $course->body = $request->input('body');
        $course->delta = $request->input('delta');
        // $course->lockable = $request->input('lockable') ? $request->input('lockable') : false;
        $course->category()->associate(Category::find($request->input('category_id')));
        $course->user()->associate(user());
        $course->save();

        if ($request->input('survey_id')) {
            $course->forms()->save(Form::find($request->input('survey_id')));
        }

        // Lessons
        collect(json_decode(json_encode($request['lessons'])))->each(function ($input, $key) use ($course) {
            $lesson = new Lesson();
            $lesson->sort = $input->sort;
            $lesson->feature = $input->feature ?? null;
            $lesson->title = $input->title;
            $lesson->body = $input->body;
            $lesson->delta = $input->delta;
            $lesson->icon = $input->icon;
            // $lesson->lockable = isset($input->lockable) ? $input->lockable : false;
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
                    // $content->lockable = isset($input->lockable) ? $input->lockable : false;
                    $content->lesson()->associate($lesson);
                    $content->library()->associate(Library::find($input->library_id));
                    $content->contentable_id = $input->contentable_id;
                    $content->contentable_type = $input->contentable_type;
                    $content->save();
                }
            }
        });

        foreach ($course->contents as $sort => $content) {
            $content = Content::find($content->id);
            $content->sort = $sort;
            $content->save();
        }

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
        $resource = Course::findOrFail($id);
        $catalogues = Catalogue::mediabox();
        $categories = Category::all();
        $surveys = Form::type('courses')->get();
        $media = Catalogue::mediabox([[
            'count' => Form::type('courses')->count(),
            'name' => 'Forms',
            'icon' => 'perm_media',
            'url' => route('api.forms.media', ['type' => 'courses'])
        ]]);

        return view("Theme::courses.edit")->with(compact('resource', 'catalogues', 'categories', 'surveys', 'media'));
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
        $course->title = $request->input('title');
        $course->slug = $request->input('slug');
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->backdrop = $request->input('backdrop');
        $course->body = $request->input('body');
        $course->delta = $request->input('delta');
        // $course->lockable = $request->input('lockable') ? $request->input('lockable') : false;
        $course->category()->associate(Category::find($request->input('category_id')));
        // $course->user()->associate(user()); // Don't Change the original author
        $course->save();

        // $course->forms()->sync($request->input('survey_id'));

        // Lessons
        $course->lessons()->whereNotIn('id', array_column($request['lessons'], 'id'))->delete();
        collect(json_decode(json_encode($request['lessons'])))->each(function ($input, $key) use ($course) {
            $lesson = Lesson::findOrNew($input->id);
            $lesson->sort = $input->sort;
            $lesson->feature = $input->feature ?? null;
            $lesson->title = $input->title;
            $lesson->body = $input->body;
            $lesson->delta = $input->delta;
            $lesson->icon = $input->icon;
            // $lesson->lockable = isset($input->lockable) ? $input->lockable : false;
            $lesson->course()->associate($course);
            if (! empty($input->assignment->title)) {
                $lesson->assignment()->associate(Assignment::updateorCreate(['id' => $input->assignment->id ?? null], (array) $input->assignment));
            }
            $lesson->save();

            // Contents
            if (isset($input->contents)) {
                $lesson->contents()->whereNotIn('id', array_column($input->contents, 'id'))->delete();
                foreach ($input->contents as $input) {
                    $content = Content::findOrNew(isset($input->id) ? $input->id : -1);
                    $content->sort = $input->sort;
                    $content->title = $input->title;
                    $content->body = $input->body;
                    $content->delta = $input->delta;
                    // $content->lockable = isset($input->lockable) ? $input->lockable : false;
                    $content->lesson()->associate($lesson);
                    $content->library()->associate(Library::find($input->library_id));
                    $content->contentable_id = $input->contentable_id;
                    $content->contentable_type = $input->contentable_type;
                    $content->save();
                }
            }
        });

        foreach ($course->contents as $sort => $content) {
            $content = Content::find($content->id);
            $content->sort = $sort;
            $content->save();
        }

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
        Course::destroy($request->has('id') ? $request->input('id') : $id);

        return redirect()->route('courses.index');
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

        return redirect()->route('courses.trashed');
    }

     /**
     * Comment the specified resource from storage permanently.
     *
     * @param  \Comment\Requests\CommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment(CommentRequest $request, $id)
    {
        // dd($request->all());
        $comment = New Comment();
        $comment->user()->associate(User::find($request->input('user_id')));
        $comment->approved = true;
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->parent_id = $request->input('parent_id');
        $comment->user()->associate(User::find(user()->id));

        $course = Course::findOrFail($id);
        $course->comments()->save($comment);
        $course->save();

        return back();
    }
}
