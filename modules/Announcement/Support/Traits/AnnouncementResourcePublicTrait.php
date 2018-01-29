<?php

namespace Announcement\Support\Traits;

use Announcement\Models\Announcement;
use Illuminate\Http\Request;

trait AnnouncementResourcePublicTrait
{
    /**
     * Retrieve list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Announcement::search($request->all())->get();

        return view("Theme::announcements.all")->with(compact('resources'));
    }

    /**
     * Try to retrieve the resource of the given slug.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $code
     * @return Illuminate\Http\Response
     */
    public function single(Request $request, $code = null)
    {
        $resource = Announcement::whereCode($code)->firstOrFail();

        return view("Theme::pages.single")->with(compact('resource'));
    }
}
