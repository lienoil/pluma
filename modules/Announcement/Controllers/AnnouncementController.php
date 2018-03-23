<?php

namespace Announcement\Controllers;

use Announcement\Models\Announcement;
use Announcement\Requests\AnnouncementRequest;
use Announcement\Support\Traits\AnnouncementResourceApiTrait;
use Announcement\Support\Traits\AnnouncementResourcePublicTrait;
use Announcement\Support\Traits\AnnouncementResourceSoftDeleteTrait;
use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use User\Models\User;

class AnnouncementController extends GeneralController
{
    use AnnouncementResourceApiTrait,
        AnnouncementResourcePublicTrait,
        AnnouncementResourceSoftDeleteTrait;

    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Announcement::search($request->all())->paginate();

        return view("Announcement::announcements.index")->with(compact('resources'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Announcement::findOrFail($id);

        return view("Announcement::announcements.show")->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $catalogues = Catalogue::mediabox();
        $categories = Category::type('announcements')->select(['name', 'icon', 'description', 'id'])->get();

        return view("Theme::announcements.create")->with(compact('catalogues', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Announcement\Requests\AnnouncementRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        $announcement = new Announcement();
        $announcement->name = $request->input('name');
        $announcement->code = $request->input('code');
        $announcement->body = $request->input('body');
        $announcement->delta = $request->input('delta');
        $announcement->feature = $request->input('feature');
        $announcement->published_at = date('Y-m-d H:i:s', strtotime($request->input('published_at')));
        $announcement->expired_at = date('Y-m-d H:i:s', strtotime($request->input('expired_at')));
        $announcement->user()->associate(User::find(user()->id));
        $announcement->category()->associate(Category::find($request->input('category_id')));
        $announcement->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $resource = Announcement::findOrFail($id);
        $catalogues = Catalogue::mediabox();
        $categories = Category::type('announcements')->select(['name', 'icon', 'description', 'id'])->get();

        return view("Theme::announcements.edit")->with(compact('resource', 'catalogues', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Announcement\Requests\AnnouncementRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(AnnouncementRequest $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->name = $request->input('name');
        $announcement->code = $request->input('code');
        $announcement->body = $request->input('body');
        $announcement->delta = $request->input('delta');
        $announcement->feature = $request->input('feature');
        $announcement->published_at = date('Y-m-d H:i:s', strtotime($request->input('published_at')));
        $announcement->expired_at = date('Y-m-d H:i:s', strtotime($request->input('expired_at')));
        $announcement->category()->associate(Category::find($request->input('category_id')));
        $announcement->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Announcement::destroy($request->has('id') ? $request->input('id') : $id);

        return redirect()->route('announcements.index');
    }
}
