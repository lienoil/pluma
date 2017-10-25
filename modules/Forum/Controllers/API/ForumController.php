<?php

namespace Forum\Controllers\API;

// use Pluma\Controllers\Controller;
use Comment\Models\Comment;
use Forum\Models\Forum;
use Forum\Requests\ForumRequest;
use Illuminate\Http\Request;
use Pluma\Controllers\APIController as Controller;
use Pluma\Models\User;

class ForumController extends Controller
{
    /**
     * Display a listing of the comments.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, $id)
    {
        // dd("CommentCOntroller", $id, $request->all());
        $data = $request->input('data');

        $comment = new Comment();
        $comment->comment = $data['content'];
        $comment->parent_id = ! empty($data['parent']) ? $data['parent'] : null;
        // $comment->created_at = $data['created'] ? $data['created'] : null;
        $comment->upvotes = $request->input('upvote_count');
        $comment->user()->associate(User::find($request->input('user_id')));
        $comment->save();

        $forum = Forum::findOrFail($id);

        $forum->comments()->save($comment);

        return response()->json(['type' => 'success', 'message' => 'Success']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request, $id)
    {
        // dd("CommentController", $id, $request->all());
        $resource = Forum::find($id);
        $data = [];

        foreach ($resource->comments as $comment) {
            $data[] = [
                "id" => $comment->id,
                "parent" => $comment->parent_id,
                "created" => $comment->created,
                "modified" => $comment->updated,
                "content" => $comment->comment,
                "pings" => [],
                "creator" => $comment->user->id,
                "fullname" => $comment->user->fullname,
                "profile_picture_url" => $comment->user->avatar,
                "created_by_admin" => $comment->user->isRoot(),
                "upvote_count" => 0,
                "user_has_upvoted" => false,
                "is_new" => false,
            ];
        }

        return response()->json($data);
    }

    /**
     * Display a listing of the comments.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd("CommentCOntroller", $id, $request->all());
        $data = $request->input('data');

        $comment = Comment::findOrFail($id);
        $comment->comment = $data['content'];
        $comment->parent_id = ! empty($data['parent']) ? $data['parent'] : null;
        // $comment->created_at = $data['created'] ? $data['created'] : null;
        $comment->upvotes = $request->input('upvote_count');
        $comment->user()->associate(User::find($request->input('user_id')));
        $comment->save();

        $forum = Forum::findOrFail($id);

        $forum->comments()->save($comment);

        return response()->json(['type' => 'success', 'message' => 'Success']);
    }
}
