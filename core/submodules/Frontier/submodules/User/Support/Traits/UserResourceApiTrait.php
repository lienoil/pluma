<?php

namespace User\Support\Traits;

use Illuminate\Http\Request;
use User\Models\User;
use User\Requests\UserRequest;

trait UserResourceApiTrait
{
    /**
     * Retrieve the resource(s) with the parameters.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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

        $resources = User::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $users = $resources->paginate($take);

        return response()->json($users);
    }

    /**
     * Retrieve list of resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
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

        $resources = User::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $users = $resources->paginate($take);

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  \User\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(UserRequest $request)
    {
        $user = new User();
        $user->title = $request->input('title');
        $user->code = $request->input('code');
        $user->feature = $request->input('feature');
        $user->body = $request->input('body');
        $user->delta = $request->input('delta');
        $user->template = $request->input('template');
        $user->user()->associate(User::find($request->input('user_id')));
        $user->save();

        return response()->json($user->id);
    }

    /**
     * Retrieve the resource specified by the slug.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function getShow(Request $request, $slug = null)
    {
        $user = User::codeOrFail($slug);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function putUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->title = $request->input('title');
        $user->code = $request->input('code');
        $user->feature = $request->input('feature');
        $user->body = $request->input('body');
        $user->delta = $request->input('delta');
        $user->template = $request->input('template');
        $user->user()->associate(User::find($request->input('user_id')));
        $user->save();

        return response()->json($user->id);
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
        $success = User::destroy($id ? $id : $request->input('id'));

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
        $user = User::onlyTrashed()->find($id);
        $user->exists() || $user->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $user = User::onlyTrashed()->find($id);
                $user->restore();
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
        $success = User::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
