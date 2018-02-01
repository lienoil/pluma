<?php

namespace Note\Support\Traits;

use Illuminate\Http\Request;
use Note\Models\Note;
use Note\Requests\NoteRequest;
use User\Models\User;

trait NoteResourceApiTrait
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

        $resources = Note::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $notes = $resources->paginate($take);

        return response()->json($notes);
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

        $resources = Note::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $notes = $resources->paginate($take);

        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Note\Requests\NoteRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(NoteRequest $request)
    {
        $note = new Note();
        $note->title = $request->input('title');
        $note->code = $request->input('code');
        $note->feature = $request->input('feature');
        $note->body = $request->input('body');
        $note->delta = $request->input('delta');
        $note->template = $request->input('template');
        $note->user()->associate(User::find($request->input('user_id')));
        $note->save();

        return response()->json($note->id);
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
        $note = Note::codeOrFail($slug);

        return response()->json($note);
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
        $note = Note::findOrFail($id);
        $note->title = $request->input('title');
        $note->code = $request->input('code');
        $note->feature = $request->input('feature');
        $note->body = $request->input('body');
        $note->delta = $request->input('delta');
        $note->template = $request->input('template');
        $note->user()->associate(User::find($request->input('user_id')));
        $note->save();

        return response()->json($note->id);
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
        $success = Note::destroy($id ? $id : $request->input('id'));

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
        $note = Note::onlyTrashed()->find($id);
        $note->exists() || $note->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $note = Note::onlyTrashed()->find($id);
                $note->restore();
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
        $success = Note::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
