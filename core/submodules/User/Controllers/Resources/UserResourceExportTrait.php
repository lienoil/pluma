<?php

namespace User\Controllers\Resources;

use Illuminate\Http\Request;

trait UserResourceExportTrait
{
    /**
     * Export the resource to a downloadable format.
     *
     * @param Illuminate\Http\Request $request
     * @param int  $id
     * @return Illuminate\Http\Response
     */
    public function export(Request $request, $id = null)
    {
        $resources = User::exportOrFail($id, $request->input('format'));

        return view("User::exports.report")->with(compact('resources'));
    }
}
