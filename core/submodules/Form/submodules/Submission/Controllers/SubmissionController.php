<?php

namespace Submission\Controllers;

use Submission\Models\Submission;
use Submission\Requests\SubmissionRequest;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Form\Models\Form;
use Field\Models\Field;
use User\Models\User;


class SubmissionController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Submission::search($request->all())->paginate();
        $trashed = Submission::onlyTrashed()->count();

        return view("Theme::submissions.index")->with(compact('resources', 'trashed'));
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
        $resource = Submission::findOrfail($id);
        $form = \Form\Model\Form::find($id);

        return view("Theme::submissions.show")->with(compact('resource', 'form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::submissions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Submission\Requests\SubmissionRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(SubmissionRequest $request)
    {
        $submisison = new Submission();
        $submisison->type = $request->input('type');
        $submission->results = $request->input('results');
        $submisison->form()->associate(Form::find(form()->id));
        $submisison->user()->associate(User::find(user()->id));

        //
        $field->name = $request->input('name');
        $field->type = $request->input('type');
        $field->results = $request->input('results');
        $field->fields = $request->input('fields');

        $field->fieldtypes = $request->input('fieldtypes');
        $field->template = $request->input('template');
        $field->code = $request->input('code');

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::submissions.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Submission\Requests\SubmissionRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(SubmissionRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return back();
    }
}
