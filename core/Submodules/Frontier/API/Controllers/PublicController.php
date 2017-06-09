<?php

namespace Frontier\API\Controllers;

class PublicController
{
    public function show($slug = null)
    {
        $response = [];

        return response()->json($response);
    }
}
