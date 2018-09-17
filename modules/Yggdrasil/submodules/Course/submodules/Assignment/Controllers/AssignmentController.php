<?php

namespace Assignment\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class AssignmentController extends GeneralController
{
    use Resources\ApiControllerTrait,
        Resources\PublicControllerTrait,
        Resources\SoftDeleteControllerTrait,
        Resources\AdminControllerTrait;

    /**
     * The constructor of the controller.
     *
     * @param DummyFullModelClass $dummyModelClass
     * @return void
     */
    public function __contruct()
    {
        //
    }
}
