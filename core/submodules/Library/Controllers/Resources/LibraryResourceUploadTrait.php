<?php

namespace Library\Controllers\Resources;

use Illuminate\Http\Request;

trait LibraryResourceUploadTrait
{
    /**
     * Upload the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $id = null)
    {
        $users = $this->repository->model()->whereIn('id', $request->input('id'))->get();
        dd($request->all());

        $headers = array(
            "Content-type" => "application/x-rar-compressed, application/octet-stream, application/zip, application/octet-stream, application/x-zip-compressed, multipart/x-zip",
            "Content-Disposition" => "attachment; filename=",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('ReviewID', 'Provider');

        $callback = function() use ($users, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, array($user->id, $user->fullname));
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);

        $resources = User::exportOrFail($id, $request->input('format'));

        return view("");

    }
}
