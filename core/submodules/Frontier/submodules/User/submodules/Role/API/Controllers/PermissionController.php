<?php

namespace Role\API\Controllers;

use Illuminate\Http\Request;
use Pluma\API\Controllers\APIController;
use Role\Models\Permission;

class PermissionController extends APIController
{
    /**
     * Get all resources.
     *
     * @param  Illuminate\Http\Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $permissions = Permission::paginate();

        return response()->json($permissions);
    }
}
