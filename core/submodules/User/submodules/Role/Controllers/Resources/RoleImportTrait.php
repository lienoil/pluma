<?php

namespace Role\Controllers\Resources;

use Illuminate\Http\Request;

trait RoleImportTrait
{
    /**
     * Import resources from file to storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $this->repository()->import($request->all());

        return back();
    }
}
