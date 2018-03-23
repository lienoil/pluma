<?php

namespace Forum\Support\Traits;

use Illuminate\Http\Request;
use Forum\Models\Forum;
use Forum\Requests\ForumRequest;
use User\Models\User;

trait ForumResourceApiTrait
{
    /**
     * Retrieve the resource(s) with the parameters.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function postFind(Request $request)
    {
        $searches = $request->get('search') !== 'null' && $request->get('search')
                        ? $request->get('search')
                        : $request->all();

        $onlyTrashed = $request->get('only_trashed') !== 'null' && $request->get('only_trashed')
                        ? $request->get('only_trashed')
                        : false;

        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null'
                        ? 'DESC'
                        : 'ASC';

        $sort = $request->get('sort') && $request->get('sort') !== 'null'
                        ? $request->get('sort')
                        : 'id';

        $take = $request->get('take') && $request->get('take') > 0
                        ? $request->get('take')
                        : 0;

        $resources = Forum::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $forums = $resources->paginate($take);

        return response()->json($forums);
    }

    /**
     * Retrieve list of resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $onlyTrashed = $request->get('only_trashed') !== 'null' && $request->get('only_trashed')
                        ? $request->get('only_trashed')
                        : false;

        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null'
                        ? 'DESC'
                        : 'ASC';

        $searches = $request->get('search') !== 'null' && $request->get('search')
                        ? $request->get('search')
                        : $request->all();

        $sort = $request->get('sort') && $request->get('sort') !== 'null'
                        ? $request->get('sort')
                        : 'id';

        $take = $request->get('take') && $request->get('take') > 0
                        ? $request->get('take')
                        : 0;

        $resources = Forum::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $forums = $resources->paginate($take);

        return response()->json($forums);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Forum\Requests\ForumRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(ForumRequest $request)
    {
        $forum = new Forum();
        $forum->title = $request->input('title');
        $forum->code = $request->input('code');
        $forum->feature = $request->input('feature');
        $forum->body = $request->input('body');
        $forum->delta = $request->input('delta');
        $forum->template = $request->input('template');
        $forum->user()->associate(User::find($request->input('user_id')));
        $forum->save();

        return response()->json($forum->id);
    }

    /**
     * Retrieve the resource specified by the slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string  $slug
     * @return Illuminate\Http\Response
     */
    public function getShow(Request $request, $slug = null)
    {
        $forum = Forum::codeOrFail($slug);

        return response()->json($forum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Role\Requests\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putUpdate(Request $request, $id)
    {
        $forum = Forum::findOrFail($id);
        $forum->title = $request->input('title');
        $forum->code = $request->input('code');
        $forum->feature = $request->input('feature');
        $forum->body = $request->input('body');
        $forum->delta = $request->input('delta');
        $forum->template = $request->input('template');
        $forum->user()->associate(User::find($request->input('user_id')));
        $forum->save();

        return response()->json($forum->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDestroy(Request $request, $id = null)
    {
        $success = Forum::destroy($id ? $id : $request->input('id'));

        return response()->json($success);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postRestore(Request $request, $id = null)
    {
        $forum = Forum::onlyTrashed()->find($id);
        $forum->exists() || $forum->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $forum = Forum::onlyTrashed()->find($id);
                $forum->restore();
            }
        }

        return response()->json($success);
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteDelete(Request $request, $id = null)
    {
        $success = Forum::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
