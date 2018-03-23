<?php

namespace Announcement\Support\Traits;

use Announcement\Models\Announcement;
use Announcement\Requests\AnnouncementRequest;
use Illuminate\Http\Request;

trait AnnouncementResourceApiTrait
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

        $resources = Announcement::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $announcements = $resources->paginate($take);

        return response()->json($announcements);
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

        $resources = Announcement::search($searches)->orderBy($sort, $order);

        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        $announcements = $resources->paginate($take);

        return response()->json($announcements);
    }

    /**
     * Store a newly created resource in storage
     *
     * @param  Announcement\Requests\AnnouncementRequest $request
     * @return Illuminate\Http\Response
     */
    public function postStore(AnnouncementRequest $request)
    {
        $announcement = new Announcement();
        $announcement->title = $request->input('title');
        $announcement->code = $request->input('code');
        $announcement->feature = $request->input('feature');
        $announcement->body = $request->input('body');
        $announcement->delta = $request->input('delta');
        $announcement->template = $request->input('template');
        $announcement->user()->associate(User::find($request->input('user_id')));
        $announcement->save();

        return response()->json($announcement->id);
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
        $announcement = Announcement::codeOrFail($slug);

        return response()->json($announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function putUpdate(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->title = $request->input('title');
        $announcement->code = $request->input('code');
        $announcement->feature = $request->input('feature');
        $announcement->body = $request->input('body');
        $announcement->delta = $request->input('delta');
        $announcement->template = $request->input('template');
        $announcement->user()->associate(User::find($request->input('user_id')));
        $announcement->save();

        return response()->json($announcement->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function deleteDestroy(Request $request, $id = null)
    {
        $success = Announcement::destroy($id ? $id : $request->input('id'));

        return response()->json($success);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function postRestore(Request $request, $id = null)
    {
        $announcement = Announcement::onlyTrashed()->find($id);
        $announcement->exists() || $announcement->restore();

        if (is_array($request->input('id'))) {
            foreach ($request->input('id') as $id) {
                $announcement = Announcement::onlyTrashed()->find($id);
                $announcement->restore();
            }
        }

        return response()->json($success);
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function deleteDelete(Request $request, $id = null)
    {
        $success = Announcement::forceDelete($id ? $id : $request->input('id'));

        return response()->json($success);
    }
}
