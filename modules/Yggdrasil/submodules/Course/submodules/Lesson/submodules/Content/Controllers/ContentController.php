<?php

namespace Content\Controllers;

use Comment\Models\Comment;
use Content\Models\Content;
use Content\Requests\ContentRequest;
use Course\Models\Course;
<<<<<<< HEAD
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
=======
use Course\Models\User;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;
>>>>>>> dev

class ContentController extends AdminController
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

        return view("Theme::contents.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $course, $lesson, $id)
    {
        $resource = Content::findOrFail($id);
        $contents = $resource->lesson->contents;
<<<<<<< HEAD

        return view("Theme::contents.show")->with(compact('resource', 'contents'));
=======
        $lesson = Lesson::findOrFail($id);

        return view("Theme::contents.show")->with(compact('resource', 'contents', 'lesson'));
>>>>>>> dev
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::contents.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Content\Requests\ContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request)
    {
        //

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

        return view("Theme::contents.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Content\Requests\ContentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request, $id)
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

        return redirect()->route('contents.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::contents.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Content\Requests\ContentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(ContentRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Content\Requests\ContentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(ContentRequest $request, $id)
    {
        //

        return redirect()->route('contents.trash');
    }

    /**
     * Comment the specified resource from storage permanently.
     *
     * @param  \Story\Requests\StoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, $id)
    {
        // dd($request->all());
        $comment = New Comment();
        $comment->user()->associate(User::find($request->input('user_id')));
        $comment->approved = true;
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->parent_id = $request->input('parent_id');
        $comment->user()->associate(User::find(user()->id));

<<<<<<< HEAD
        $course = Course::findOrFail($id);
        $course->comments()->save($comment);
        $course->save();
=======
        $content = Content::findOrFail($id);
        $content->comments()->save($comment);
        $content->save();
>>>>>>> dev

        return back();
    }
}
