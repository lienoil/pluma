<?php

namespace Submission\Support\Traits;

use Submission\Models\Submission;

trait CanViewResultTrait
{
    /**
     * View the results of a given resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function results(Request $request, $id)
    {
        $resource = Submission::findOrFail($id);

        return view("Submissions::submissions.results")->with(compact('resource'));
    }
}
