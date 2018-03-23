<?php

namespace Announcement\Support\Traits;

use Announcement\Models\Announcement;
use Illuminate\Http\Request;

trait AnnouncementResourceSoftDeleteTrait
{
	/**
     * Display a listing of the trashed resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function trashed(Request $request)
    {
        $resources = Announcement::onlyTrashed()
        						 ->search($request->all())
        						 ->paginate();

        return view("Theme::announcements.trashed")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $announcements = Announcement::onlyTrashed()
        					->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
        					->get();

        foreach ($announcements as $announcement) {
            $announcement->restore();
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
        $announcements = Announcement::onlyTrashed()
	                     ->whereIn('id', $request->has('id') ? $request->input('id') : [$id])
	                     ->get();

	    foreach ($announcements as $announcement) {
            $announcement->forceDelete();
        }

        return back();
    }
}
