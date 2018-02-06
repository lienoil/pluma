<?php

namespace Submission\Support\Traits;

use Illuminate\Http\Request;
use Submission\Models\Submission;
use Submission\Support\Dompdf\PDF;

trait CanExportResultTrait
{
    /**
     * Export to spread sheet or pdf the given resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request, $id)
    {
        $resource = Submission::findOrFail($id);

        $file = new PDF();
        $file->loadView("Submission::templates.submissions", [
                'resource' => $resource,
             ])
             ->setPaper('A4')
             ->render();

        return $file->stream(settings("export_name_pdf", "{$resource->form->name} - {$resource->user->fullname}"), [
            "Attachment" => $request->input('attachment') ?? false
        ]);
    }
}
