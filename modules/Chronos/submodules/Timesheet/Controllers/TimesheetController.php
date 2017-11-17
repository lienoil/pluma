<?php

namespace Timesheet\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Timesheet\Models\Timesheet;
use Timesheet\Requests\TimesheetRequest;
use DateTime;

class TimesheetController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::timesheets.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::timesheets.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::timesheets.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Timesheet\Requests\TimesheetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimesheetRequest $request)
    {
        $timeIn = DateTime::createFromFormat('H:i:s', date('H:i:s', strtotime($request->input('time_in'))));
        $timeOut = DateTime::createFromFormat('H:i:s', date('H:i:s', strtotime($request->input('time_out'))));
        $dateStart = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($request->input('from_date'))));
        $dateEnd = DateTime::createFromFormat('Y-m-d', date('Y-m-d', strtotime($request->input('to_date'))));

        $current = clone $dateStart;

        while ($current < $dateEnd) {
            $timesheet = new Timesheet();
            $timesheet->date = $current;
            $timesheet->in = $timeIn;
            $timesheet->out = $timeOut;
            $hours = $timeOut->diff($timeIn);
            $timesheet->hours = ($timeOut->diff($timeIn))->format('%h:%i:%s');
            $timesheet->user()->associate(user());
            $timesheet->save();

            $current = $current->modify('+1 day');
        }

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::timesheets.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Timesheet\Requests\TimesheetRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TimesheetRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('timesheets.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::timesheets.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Timesheet\Requests\TimesheetRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(TimesheetRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Timesheet\Requests\TimesheetRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(TimesheetRequest $request, $id)
    {
        //

        return redirect()->route('timesheets.trash');
    }
}
