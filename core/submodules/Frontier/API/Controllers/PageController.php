<?php

namespace Frontier\API\Controllers;

use Pluma\API\Controllers\APIController;

class PageController extends APIController
{
    /**
     *
     * @param  [type] $slug [description]
     * @return [type]       [description]
     */
    public function show($slug = null)
    {
        $response = ['test' => 'asd'];

        return response()->json($response);
    }
}
