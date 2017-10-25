<?php

namespace Announcement\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Announcement\Models\Announcement;
use Announcement\Requests\AnnouncementRequest;

class AnnouncementController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Announcement::paginate();
        $trashed = Announcement::onlyTrashed()->count();

        return view("Theme::announcements.index")->with(compact('resources', 'trashed'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Announcement::findOrFail($id);
        $trashed = Announcement::onlyTrashed()->count();

        return view("Theme::announcements.show")->with(compact('resource', 'trashed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::announcements.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Announcement\Requests\AnnouncementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        $announcement = new Announcement();
        $announcement->name = $request->input('name');
        $announcement->code = $request->input('code');
        $announcement->description = $request->input('description');
        if (null !== $request->input('schedule')) {
            $announcement->schedule = date('Y-m-d H:i:s', strtotime($request->input('schedule')));
        }
        $announcement->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = Announcement::findOrFail($id);

        return view("Theme::announcements.edit")->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Announcement\Requests\AnnouncementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnnouncementRequest $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->name = $request->input('name');
        $announcement->code = $request->input('code');
        $announcement->description = $request->input('description');
        if (null !== $request->input('schedule')) {
            $announcement->schedule = date('Y-m-d H:i:s', strtotime($request->input('schedule')));
        }
        $announcement->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('announcements.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        $resources = Announcement::onlyTrashed()->paginate();

        return view("Theme::announcements.trash")->with(compact('resources'));
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Announcement\Requests\AnnouncementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $announcement = Announcement::onlyTrashed()->findOrFail($id);
        $announcement->restore();

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Announcement\Requests\AnnouncementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id)
    {
        $announcement = Announcement::withTrashed()->findOrFail($id);
        $announcement->forceDelete();

        return redirect()->route('announcements.trash');
    }
}
