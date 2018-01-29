<?php

namespace Forum\Controllers;

use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Comment\Models\Comment;
use Forum\Models\Forum;
use Forum\Requests\ForumRequest;
use Forum\Support\Traits\ForumResourceApiTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use User\Models\User;

class ForumController extends GeneralController
{
    use ForumResourceApiTrait;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Forum::search($request->all())->paginate();
        $categories = Category::type('forums')->select(['name', 'icon', 'id'])->get();

        return view("Theme::forums.index")->with(compact('resources', 'catalogues', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $code
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $code)
    {
        $resource = Forum::whereCode($code)->firstOrFail();

        return view("Theme::forums.show")->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::all();
        $categories = Category::type('forums')->select(['name', 'icon', 'id'])->get();

        return view("Theme::forums.create")->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Forum\Requests\ForumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumRequest $request)
    {
        $forum = new Forum();
        $forum->name = $request->input('name');
        $forum->code = date('ymdhis') . str_slug($request->input('name'));
        $forum->body = $request->input('body');
        $forum->delta = $request->input('delta');
        $forum->user()->associate(User::find(user()->id));
        $forum->category()->associate(Category::find($request->input('category_id')));
        $forum->save();

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
        $resource = Forum::findOrFail($id);
        $categories = Category::all();
        $categories = Category::type('forums')->select(['name', 'icon', 'id'])->get();

        return view("Theme::forums.edit")->with(compact('resource', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Forum\Requests\ForumRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumRequest $request, $id)
    {
        $forum = Forum::findOrFail($id);
        $forum->name = $request->input('name');
        $forum->code = $request->input('code');
        $forum->body = $request->input('body');
        $forum->category()->associate(Category::find($request->input('category_id')));
        $forum->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
        Forum::destroy($request->has('id') ? $request->input('id') : $id);

        return back();
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
        $comment = New Comment();
        $comment->user()->associate(User::find($request->input('user_id')));
        $comment->approved = true;
        $comment->body = $request->input('body');
        $comment->delta = $request->input('delta');

        $forum = Forum::findOrFail($id);
        $forum->comments()->save($comment);
        $forum->save();

        return back();
    }
}
