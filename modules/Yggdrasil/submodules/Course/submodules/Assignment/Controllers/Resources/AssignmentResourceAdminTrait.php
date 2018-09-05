<?php

namespace Assignment\Controllers\Resources;

use Illuminate\Http\Request;

trait AssignmentResourceAdminTrait
{
    /**
     * Show list of resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $resources = Assignment::search($request->all())->paginate();

        // return view('Assignment::assignments.index')->with(compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // return view('assignments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Assignment\Requests\AssignmentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentRequest $request)
    {
        # code...
    }

    /**
     * Show a given resource.
     *
     * @param  \Illuminate\Http\Request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        # code...
    }

    /**
     * Show the form, editing the specified
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // $resource = Assignment::findOrFail($id);
        // return view('assignments.edit')->with(compact('resource'));
    }

    /**
     * Update the specified resource in storage
     *
     * @param  Assignment\Request\AssignmentRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignmentRequest $request, $id)
    {
        # code...
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // $assignment = Assignment::findOrFail($id);
        // $assignment->delete();

        // return redirect()->route('assignments.index');
    }

}
