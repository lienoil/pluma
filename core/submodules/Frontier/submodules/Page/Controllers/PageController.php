<?php

namespace Page\Controllers;

use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;
use Page\Models\Page;

class PageController extends Controller
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Page::paginate();
        $trashed = Page::onlyTrashed()->count();

        return view("Page::pages.index")->with(compact('resources', 'trashed'));
    }

    /**
     * Show a given page resource.
     *
     * @param  Request $request
     * @param  string  $slug
     * @return Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $resource = Page::findOrFail($request->get('page'));

        return view("Page::pages.show")->with(compact('resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view("Page::pages.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        $page->title = $request->input('title');
        $page->slug = $request->input('slug');
        $page->body = $request->input('body');
        $page->delta = $request->input('delta');
        $page->save();

        return back();
    }
}
