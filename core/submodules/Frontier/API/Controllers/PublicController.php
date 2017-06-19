<?php

namespace Frontier\API\Controllers;

use Pluma\API\Controllers\APIController;

class PublicController extends APIController
{
    public function show($slug = null)
    {
        $response = ['test' => 'asd'];

        return response()->json($response);
    }
}
