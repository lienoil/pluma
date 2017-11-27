<?php

namespace Page\Controllers;

use Crowfeather\Traverser\Traverser;
use Frontier\Controllers\AdminController as Controller;
use Illuminate\Http\Request;
use Page\Models\Page;
use Template\Models\Template;
use User\Models\User;

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

    public function edit(Request $request, $id)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        $resource = Page::sharedLock()->findOrFail($id);
        \Illuminate\Support\Facades\DB::commit();

        return view("Page::pages.edit")->with(compact('resource'));
    }

    public function update(Request $request, $id)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();
        $page = Page::findOrFail($id);
        $page->title = $request->input('title');
        $page->code = $request->input('code');
        $page->feature = $request->input('feature');
        $page->body = $request->input('body');
        $page->delta = $request->input('delta');
        $page->template = $request->input('template');
        $page->user()->associate(User::find(user()->id));
        $page->save();
        \Illuminate\Support\Facades\DB::commit();

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $templates = Template::getTemplatesFromFiles();

        return view("Page::pages.create")->with(compact('templates'));
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
        $page->code = $request->input('code');
        $page->feature = $request->input('feature');
        $page->body = $request->input('body');
        $page->delta = $request->input('delta');
        $page->template = $request->input('template');
        $page->user()->associate(User::find(user()->id));
        $page->save();

        return back();
    }
}
