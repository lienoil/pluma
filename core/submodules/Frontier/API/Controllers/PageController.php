<?php

namespace Frontier\API\Controllers;

use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;

class PageController extends APIController
{
    /**
     * Get all pages.
     *
     * @param  Illuminate\Http\Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $response = [
            'test' => 'asd',
            'page' => 'page-s',
        ];

        return response()->json($response);
    }
}
