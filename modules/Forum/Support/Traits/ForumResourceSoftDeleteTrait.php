<?php

namespace Forum\Support\Traits;

use Illuminate\Http\Request;
use Forum\Models\Forum;

trait ForumResourceSoftDeleteTrait
{
    /**
     * Display a listing of the trashed resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Forum::onlyTrashed()
                         ->search($request->all())
                         ->paginate();

        return view("Forum::forums.trashed")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function restore(Request $request, $id = null)
    {
        $forums = Forum::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($forums as $forum) {
            $forum->restore();
        }

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $forums = Forum::onlyTrashed()
                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
                     ->get();

        foreach ($forums as $forum) {
            $forum->forceDelete();
        }

        return back();
    }
}
