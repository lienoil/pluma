<?php

namespace Timesheet\Controllers;

use Category\Models\Category;
use DateTime;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory as Spreadsheet;
use Timesheet\Models\Daily;
use Timesheet\Models\Timesheet;
use Timesheet\Requests\TimesheetRequest;
use User\Models\User;
use User\Requests\OwnerRequest;

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
     * @param  \User\Requests\OwnerRequest $request
     * @param  string  $handlename
     * @return \Illuminate\Http\Response
     */
    public function show(OwnerRequest $request, $handlename)
    {
        $user = User::whereUsername($handlename)->firstOrFail();
        $resources = Timesheet::belongsToUser($user->id)->get();

        return view("Theme::timesheets.show")->with(compact('resources', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::type('timesheets')->pluck('name', 'id');

        return view("Theme::timesheets.create")->with(compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Timesheet\Requests\TimesheetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimesheetRequest $request)
    {
        $timesheet = new Timesheet();
        $timesheet->name = $request->input('name');
        $timesheet->code = $request->input('code');
        $timesheet->description = $request->input('description');
        $timesheet->user()->associate($request->input('user_id')?User::find($request->input('user_id')):user()->id);
        $timesheet->save();

        foreach ($request->input('dates') as $date) {
            $timeIn = DateTime::createFromFormat('H:i:s', date('H:i:s', strtotime($date['time_in'])));
            $timeOut = DateTime::createFromFormat('H:i:s', date('H:i:s', strtotime($date['time_out'])));

            $daily = new Daily();
            $daily->work = $request->input('work');
            $daily->month = date('m', strtotime($date['date']));
            $daily->date = date('Y-m-d', strtotime($date['date']));
            $daily->time_in = $timeIn;
            $daily->time_out = $timeOut;
            $daily->hours = ($timeOut->diff($timeIn))->format('%h:%i:%s');
            $daily->category()->associate(
                Category::firstOrCreate(
                    ['code' => str_slug($request->input('category_name'))],
                    [
                        'name' => $request->input('category_name'),
                        'alias' => $request->input('category_name'),
                        'code' => str_slug($request->input('category_name')),
                        'icon' => 'label',
                        'categorable_type' => Timesheet::categorable(),
                    ]
                )
            );
            $daily->timesheet()->associate($timesheet);
            $daily->save();
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

    /**
     * Generate report from resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generate(Request $request, $id)
    {
        $timesheet = Timesheet::findOrFail($id);

        $spreadsheet = Spreadsheet::load(module_path('timesheet/templates/spreadsheets/test.xlsx'));

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->setOffice2003Compatibility(true);
        $worksheet = $spreadsheet->getActiveSheet(); // setSheetIndex(0);

        $worksheet->getCell('B5')->setValue($timesheet->user->fullname);

        foreach ($timesheet->dailies as $daily) {
            foreach ($worksheet->getRowIterator(10) as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                foreach ($cellIterator as $cell) {
                    $cell->setValue(date('h', strtotime($daily->hours)));
                }
            }
        }

        // // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        header('Content-Disposition: attachment; filename="file.xls"');
        $writer->save('php://output');
    }
}
