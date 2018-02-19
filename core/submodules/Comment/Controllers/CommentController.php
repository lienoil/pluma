<?php

namespace Comment\Controllers;

use Comment\Models\Comment;
use Comment\Requests\CommentRequest;
use Comment\Support\Traits\CommentResourceApiTrait;
use Comment\Support\Traits\CommentResourcePublicTrait;
use Comment\Support\Traits\CommentResourceSoftDeleteTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class CommentController extends GeneralController
{
    use CommentResourceApiTrait,
        CommentResourcePublicTrait,
        CommentResourceSoftDeleteTrait;

    /**
     * The view hintpath.
     *
     * @var string
     */
    protected $hintpath = 'Theme::comments';

    /**
     * The category type of the resource.
     *
     * @var string
     */
    protected $type = 'default';

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hintpath = $this->hintpath;
        $resources = Comment::type($this->type)->paginate();

        return view("$hintpath.index");
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

        return view("Theme::comments.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::comments.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Comment\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->user_id = $request->input('user_id');
        $comment->approved = 1;
        $comment->parent_id = $request->input('parent_id');
        $comment->commentable_id = $request->input('commentable_id');
        $comment->commentable_type = $request->input('commentable_type');
        $comment->save();

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

        return view("Theme::comments.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Comment\Requests\CommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
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

        return redirect()->route('comments.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $resources = Comment::onlyTrashed()->paginate();

        return view("Theme::comments.trash")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Comment\Requests\CommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(CommentRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Comment\Requests\CommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(CommentRequest $request, $id)
    {
        //

        return redirect()->route('comments.trash');
    }
}
