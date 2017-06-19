<?php

namespace Frontier\Controllers;

use Illuminate\Http\Request;
use Pluma\Frontier\Support\View\CheckView;
use Pluma\Models\Task;

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
        return dd($request);
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
        // if (Task::whereSlug($slug)->exists()) {
        //     dd("s");
        // }

        return $this->view($slug, "Frontier::welcome.")->with(['description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis dignissimos reiciendis dicta iusto cumque. Officiis, fugit cupiditate. Tenetur rerum iure ducimus. Enim, est, aliquid. Iusto nobis suscipit voluptatem voluptas reprehenderit?']);
    }
}
