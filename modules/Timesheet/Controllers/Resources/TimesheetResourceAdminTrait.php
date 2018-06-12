<?php

namespace Timesheet\Controllers\Resources;

use Illuminate\Http\Request;
use Timesheet\Models\Timesheet;

trait TimesheetResourceAdminTrait
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Timesheet::search($request->all())->paginate();

        return view("Theme::timesheets.index")->with(compact('resources'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $resource = Timesheet::findOrFail($id);

        return view("Timesheet::timesheets.show")->with(compact('resource'));
    }
}
