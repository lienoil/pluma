<?php

namespace Library\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Library\Models\Library;
use Library\Requests\LibraryRequest;

class LibraryController extends GeneralController
{
    use Resources\LibraryResourceApiTrait,
        Resources\LibraryResourceUploadTrait,
        Resources\LibraryResourceAdminTrait;
}
