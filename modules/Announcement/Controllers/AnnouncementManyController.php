<?php

namespace Announcement\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Announcement\Models\Announcement;

class AnnouncementManyController extends AdminController
{
    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request)
    {
        foreach ($request->input('announcements') as $id) {
            $announcement = Announcement::onlyTrashed()->findOrFail($id);
            $announcement->restore();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->input('announcements') as $id) {
            $announcement = Announcement::findOrFail($id);
            $announcement->delete();
        }

        return redirect()->route('announcements.index');
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        foreach ($request->input('announcements') as $id) {
            $announcement = Announcement::withTrashed()->findOrFail($id);
            $announcement->forceDelete();
        }

        return back();
    }
}
