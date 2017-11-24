<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;
use Frontier\Support\View\CheckView;
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
        // First check database.
        $slug = is_null($slug) ? config('path.home', 'home') : $slug;
        $page = Page::whereSlug($slug)->first();

        if ($page && $page->exists()) {
            // Page exists, look for a template.
            if (view()->exists("Template::templates.{$page->template}")) {
                // Disco.
                // remove this menus, put in ViewComposer
                $menus = Page::
                $menus = Page::select(['title', 'slug', 'code', 'id', 'parent_id'])->get();
                $menus = new \Crowfeather\Traverser\Traverser($menus->toArray(), ['root' => ['id' => 'root']], ['name' => 'id', 'parent' => 'parent_id']);
                $menus = \Crowfeather\Traverser\Traverser::recursiveArrayValues($menus->reorderViaChildKnowsParent(), 'children');
                $menus = json_decode(json_encode($menus));

                return view("Template::templates.{$page->template}")->with(compact('page', 'menus'));
            }

            return view("Template::templates.index")->with(compact('page'));
        }

        // Static
        if (view()->exists("Static::$slug")) {
            return view("Static::$slug")->with(compact('page'));
        }

        return abort(404);
    }
}
