<?php

namespace Content\Controllers\Resources;

use Comment\Models\Comment;
use Content\Models\Content;
use Content\Requests\ContentRequest;
use Course\Models\Course;
use Course\Models\User;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;

trait ContentResourceAdminTrait
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view("Theme::contents.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $course, $lesson, $id)
    {
        $resource = Content::with('lesson.course')->find($id);
        $course = Course::with('lessons')->whereSlug($course)->first();

        return view("Theme::contents.show")->with(compact('resource', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Theme::contents.create");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Content\Requests\ContentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request)
    {
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
        return view("Theme::contents.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Content\Requests\ContentRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request, $id)
    {
        return redirect()->route('contents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        return redirect()->route('contents.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Https\Response
     */
    public function trash()
    {
        return view("Theme::contents.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Content\Requests\ContentRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function restore(ContentRequest $request, $id)
    {
        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Content\Requests\ContentRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delte(ContentRequest $request, $id)
    {
        return redirect()->route('contents.trash');
    }

    /**
     * Comment the specified resource from storage permanently.
     *
     * @param  \Story\Requests\StoryRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, $id)
    {
        $comment = New Comment();
        $comment->user()->associate(User::find($request->input('user_id')));
        $comment->approved = true;
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->parent_id = $request->input('parent_id');
        $comment->user()->associate(User::find(user()->id));

        $content = Content::findOrFail($id);
        $content->comments()->save($comment);
        $content->save();

        return back();
    }
}
