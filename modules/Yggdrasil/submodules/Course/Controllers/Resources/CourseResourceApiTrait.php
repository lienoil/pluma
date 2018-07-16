<?php

namespace Course\Controllers\Resources;

use Illuminate\Http\Request;
use Role\Models\Role;
use Course\Models\Course;
use Course\Requests\CourseRequest;
use Course\Resources\CourseCollection;

trait CourseResourceApiTrait
{
    /**
     * Retrieve list of resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $onlyTrashed = (bool) $request->get(self::KEY_ONLY_TRASHED);

        $order = $request->get(self::KEY_DESCENDING) === 'true'
                 ? 'DESC'
                 : 'ASC';

        $searches = (bool) $request->get(self::KEY_SEARCH)
                    ? $request->get(self::KEY_SEARCH)
                    : $request->all();

        $sort = (bool) $request->get(self::KEY_SORT)
                ? $request->get(self::KEY_SORT)
                : 'id';

        $take = (int) $request->get(self::KEY_SORT) > 0
                ? $request->get(self::KEY_SORT)
                : 0;

        $resources = Course::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $users = $take ? $resources->paginate($take) : $resources->paginate(Course::count());

        return new CourseCollection($users);
    }

    /**
     * Retrieve the resource(s) with the parameters.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function postFind(Request $request)
    {
        $searches = $request->get(self::KEY_SEARCH) !== 'null' && $request->get(self::KEY_SEARCH)
                        ? $request->get(self::KEY_SEARCH)
                        : $request->all();

        $onlyTrashed = $request->get(self::KEY_ONLY_TRASHED) !== 'null' && $request->get(self::KEY_ONLY_TRASHED)
                        ? $request->get(self::KEY_ONLY_TRASHED)
                        : false;

        $order = $request->get(self::KEY_DESCENDING) === 'true' && $request->get(self::KEY_DESCENDING) !== 'null'
                        ? 'DESC'
                        : 'ASC';

        $sort = $request->get(self::KEY_SORT) && $request->get(self::KEY_SORT) !== 'null'
                        ? $request->get(self::KEY_SORT)
                        : 'id';

        $take = $request->get(self::KEY_SORT) && $request->get(self::KEY_SORT) > 0
                        ? $request->get(self::KEY_SORT)
                        : 0;

        $resources = Course::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $users = $resources->paginate($take);

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Course\Requests\CourseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(CourseRequest $request)
    {
        $user = new Course();
        $user->prefixname = $request->input('prefixname');
        $user->firstname = $request->input('firstname');
        $user->middlename = $request->input('middlename');
        $user->lastname = $request->input('lastname');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->avatar = $request->input('avatar');
        $user->tokenize($request->input('username'));
        $user->save();

        // $user->role()->associate(Role::find($request->input('roles')));

        // Details
        foreach (($request->input('details') ?? []) as $key => $value) {
            $user->details()->create(['key' => $key, 'value' => $value]);
        }

        return response()->json($user->id);
    }

    /**
     * Retrieve the resource specified by the slug.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  id  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow(Request $request, $id)
    {
        $user = Course::findOrFail($id);

        return new CourseResource($user);
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
        $user = Course::findOrFail($id);
        $user->title = $request->input('title');
        $user->code = $request->input('code');
        $user->feature = $request->input('feature');
        $user->body = $request->input('body');
        $user->delta = $request->input('delta');
        $user->template = $request->input('template');
        $user->user()->associate(Course::find($request->input('user_id')));
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
        $success = Course::destroy($id ? $id : $request->input('id'));

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
        $user = Course::onlyTrashed()->find($id);
        $user->exists() || $user->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $user = Course::onlyTrashed()->find($id);
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
        $success = Course::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
