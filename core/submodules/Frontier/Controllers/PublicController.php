<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;
use Frontier\Support\View\CheckView;
use Page\Models\Page;

class PublicController
{
    use CheckView;

    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return abort(404);
    }

    /**
     * Show a given page resource.
     *
     * @param  Request $request
     * @param  string  $slug
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $slug = null)
    {
        // First check database.
        $page = Page::whereSlug(($slug == "" ? config("path.home", 'home') : $slug))->first();

        if ($page && $page->exists()) {
            return view("Theme::pages.show")->with(compact('page'));
        }

        return abort(404);
    }
}
