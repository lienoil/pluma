<?php

namespace Course\Support\Traits;

use Illuminate\Http\Request;
use Course\Models\Course;
use Course\Requests\CourseRequest;
use User\Models\User;

trait CourseResourceApiTrait
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

        $resources = Course::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $courses = $resources->paginate($take);

        return response()->json($courses);
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

        $resources = Course::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $courses = $resources->paginate($take);

        return response()->json($courses);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Course\Requests\CourseRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(CourseRequest $request)
    {
        $course = new Course();
        $course->title = $request->input('title');
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->body = $request->input('body');
        $course->delta = $request->input('delta');
        $course->template = $request->input('template');
        $course->user()->associate(User::find($request->input('user_id')));
        $course->save();

        return response()->json($course->id);
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
        $course = Course::codeOrFail($slug);

        return response()->json($course);
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
        $course = Course::findOrFail($id);
        $course->title = $request->input('title');
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->body = $request->input('body');
        $course->delta = $request->input('delta');
        $course->template = $request->input('template');
        $course->user()->associate(User::find($request->input('user_id')));
        $course->save();

        return response()->json($course->id);
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
        $course = Course::onlyTrashed()->find($id);
        $course->exists() || $course->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $course = Course::onlyTrashed()->find($id);
                $course->restore();
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
