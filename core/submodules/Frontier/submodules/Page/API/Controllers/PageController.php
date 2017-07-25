<?php

namespace Page\API\Controllers;

use Illuminate\Http\Request;
use Page\Models\Page;
use Pluma\API\Controllers\APIController;

class PageController extends APIController
{
    /**
     * Show list of resources.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        $pages = Page::paginate($request->get('paginate'));

        return response()->json($pages);
    }
}
