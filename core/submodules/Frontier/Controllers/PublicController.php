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
        $slug = is_null($slug) ? config('path.home', 'home') : $slug;
        $page = Page::whereSlug($slug)->first();

        if ($page && $page->exists()) {
            if (view()->exists("Theme::pages.{$page->slug}")) {
                return view("Theme::pages.{$page->slug}")->with(compact('page'));
            }

            return view("Theme::index")->with(compact('page'));
        }

        // Static
        if (view()->exists("Static::$slug")) {
            return view("Static::$slug")->with(compact('page'));
        }

        return abort(404);
    }
}
