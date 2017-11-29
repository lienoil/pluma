<?php

namespace Frontier\Controllers;

use Frontier\Support\View\CheckView;
use Illuminate\Http\Request;
use Menu\Models\Menu;
use Page\Models\Page;

class PublicController
{
    // use CheckView;

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
        // Trial 1: Database check.
        $slug = is_null($slug) ? config('path.home', 'home') : $slug;
        $menu = Menu::whereSlug($slug)->first();
        if ($menu && $page = $this->page($menu->page_id)) {
            // Trial 1.1: Look for slug specific views
            if (view()->exists("Theme::pages.{$page->code}")) {
                return view("Theme::pages.{$page->code}")->with(compact('page'));
            }

            // Trial 1.2: Look for templates
            // Page exists, look for a template.
            $page->template = isset($page->template) && ! is_null($page->template)
                            ? $page->template
                            : 'generic';
            if (view()->exists("Theme::templates.{$page->template}")) {
                // Disco.
                return view("Theme::templates.{$page->template}")->with(compact('page'));
            }


            return view("Theme::templates.index")->with(compact('page'));
        }
        // Trail 2: redirect, but not really needed since the app won't process
        // a url with different domain. ^_^
        /*else {
             return redirect($slug);
        }*/


        // Trial 2: Check static files.
        if (view()->exists("Static::$slug")) {
            return view("Static::$slug")->with(compact('page'));
        }

        // Give up.
        return abort(404);
    }

    /**
     * Gets the page of a given id.
     *
     * @param  int $id
     * @return mixed
     */
    public function page($id)
    {
        if (is_null($id)) {
            return false;
        }

        $page = Page::find($id);

        return $page;
    }
}
