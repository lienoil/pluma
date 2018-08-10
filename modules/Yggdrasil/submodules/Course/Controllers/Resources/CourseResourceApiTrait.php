<?php

namespace Course\Controllers\Resources;

use Course\Models\Course;
use Course\Requests\CourseRequest;
use Course\Resources\CourseCollection;
use Illuminate\Http\Request;
use Role\Models\Role;
use Course\Resources\Course as CourseResource;

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

        $course = $take ? $resources->paginate($take) : $resources->paginate(Course::count());

        return response()->json($course);
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

        $course = $resources->paginate($take);

        return response()->json($course);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Course\Requests\CourseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(CourseRequest $request)
    {
        $course = new Course();
        $course->title = $request->input('title');
        $course->slug = $request->input('slug');
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->backdrop = $request->input('backdrop');
        $course->body = $request->input('body');
        $course->save();

        // Details
        foreach (($request->input('details') ?? []) as $key => $value) {
            $course->details()->create(['key' => $key, 'value' => $value]);
        }

        return response()->json($course->id);
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
        $course = Course::findOrFail($id);

        return new CourseResource($course);
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
        $course = Course::findOrFail($id);
        $course->title = $request->input('title');
        $course->code = $request->input('code');
        $course->feature = $request->input('feature');
        $course->body = $request->input('body');
        $course->delta = $request->input('delta');
        $course->template = $request->input('template');
        $course->course()->associate(Course::find($request->input('course_id')));
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
    public function postDelete(Request $request, $id = null)
    {
        $success = Course::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
