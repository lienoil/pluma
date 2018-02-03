<?php

namespace Submission\Support\Traits;

use Illuminate\Http\Request;
use Submission\Models\Submission;
use Submission\Requests\SubmissionRequest;
use User\Models\User;

trait SubmissionResourceApiTrait
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

        $resources = Submission::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $submissions = $resources->paginate($take);

        return response()->json($submissions);
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

        $resources = Submission::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $submissions = $resources->paginate($take);

        return response()->json($submissions);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Submission\Requests\SubmissionRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(SubmissionRequest $request)
    {
        $submission = new Submission();
        $submission->title = $request->input('title');
        $submission->code = $request->input('code');
        $submission->feature = $request->input('feature');
        $submission->body = $request->input('body');
        $submission->delta = $request->input('delta');
        $submission->template = $request->input('template');
        $submission->user()->associate(User::find($request->input('user_id')));
        $submission->save();

        return response()->json($submission->id);
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
        $submission = Submission::codeOrFail($slug);

        return response()->json($submission);
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
        $submission = Submission::findOrFail($id);
        $submission->title = $request->input('title');
        $submission->code = $request->input('code');
        $submission->feature = $request->input('feature');
        $submission->body = $request->input('body');
        $submission->delta = $request->input('delta');
        $submission->template = $request->input('template');
        $submission->user()->associate(User::find($request->input('user_id')));
        $submission->save();

        return response()->json($submission->id);
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
        $success = Submission::destroy($id ? $id : $request->input('id'));

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
        $submission = Submission::onlyTrashed()->find($id);
        $submission->exists() || $submission->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $submission = Submission::onlyTrashed()->find($id);
                $submission->restore();
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
        $success = Submission::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}