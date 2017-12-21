<?php

namespace Quest\Support\Traits;

use Illuminate\Http\Request;
use Quest\Models\Quest;

trait PublicQuestTrait
{
    /**
     * Get list of all resources.
     *
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $resources = Quest::search($request->except(['_token']))
                        ->paginate();

        return view("Theme::quests.all")->with(compact('resources'));
    }

    /**
     * Show a single resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  string $slug The string to query.
     * @return Illuminate\Http\Response
     */
    public function single(Request $request, $slug = null)
    {
        $resource = Quest::slugOrFail($slug);

        return view("Theme::quests.single")->with(compact('resource'));
    }
}
