<?php

namespace Library\Controllers\Resources;

use Catalogue\Models\Catalogue;
use Illuminate\Http\Request;
use Library\Models\Library;
use Library\Requests\UploadRequest;

trait LibraryResourceUploadTrait
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Library\Request\LibraryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function upload(UploadRequest $request)
    {
        try {
            $file = $request->file('file');
            if (is_array($file) && $files = $file) {
                foreach ($files as $file) {
                    $this->save($request, $file);
                }
            } else {
                $library = $this->save($request, $file);
                if ($request->input('return')) {
                    return response()->json($library);
                }
            }
        } catch (\Exception $e) {
            return response()->json($library);
        }

        return response()->json($this->successResponse);
    }

    /**
     * Save the library
     *
     * @param  File $file
     * @return boolean
     */
    public function save($request, $file)
    {
        $originalName = $file->getClientOriginalName();
        $date = date('Y-m-d');
        $filePath = storage_path(settings('library.storage_path', 'public/library')) . "/$date";

        $name = (bool) $request->input('originalname') ? pathinfo($request->input('originalname'), PATHINFO_FILENAME) : pathinfo($originalName, PATHINFO_FILENAME);

        $fileName = str_slug($name);
        $fileName .= ".".$file->getClientOriginalExtension();

        $fullFilePath = "$filePath/$fileName";

        if ($file->move($filePath, $fileName)) {
            $library = new Library();
            $library->name = $name;
            $library->originalname = $originalName;
            $library->pathname = $fullFilePath;
            $library->mimetype = $file->getClientMimeType();
            $library->thumbnail = settings('library.storage_path', 'public/library') . "/$date/$fileName";
            $library->size = $file->getClientSize();
            $library->url = settings('library.storage_path', 'public/library') . "/$date/$fileName";
            if ((bool) $request->input('catalogue_id')) {
                $library->catalogue()->associate(Catalogue::find($request->input('catalogue_id')));
            }
            $library->save();

            if ($request->input('extract') && Library::isExtractable($library->mimetype)) {
                $output = storage_path(settings('package.storage_path', 'public/package'))."/$date/{$library->id}";
                Library::extract($fullFilePath, $output);
            }

            return $library;
        }

    }
}
