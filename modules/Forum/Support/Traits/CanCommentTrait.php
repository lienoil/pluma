<?php

namespace Forum\Support\Traits;

use Comment\Models\Comment;
use Forum\Requests\CommentRequest;
use Forum\Models\Forum;
use User\Models\User;

trait CanCommentTrait
{
    /**
     * Comment the specified resource from storage permanently.
     *
     * @param  \Comment\Requests\CommentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function comment(CommentRequest $request, $id)
    {
        $comment = new Comment();
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');
        $comment->approved = settings('forum_display_unapproved_comments', 1);
        $comment->parent_id = $request->input('parent_id') ?? null;
        $comment->user()->associate(User::find($request->input('user_id')));

        if (is_null($request->input('parent_id'))) {
            $forum = Forum::findOrFail($id);
            $forum->comments()->save($comment);
            $forum->save();
        } else {
            $comment->save();
        }


        return back();
    }
}
