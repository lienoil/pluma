<?php

namespace Test\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class TestController extends GeneralController
{
    use Resources\ApiControllerTrait,
        Resources\PublicControllerTrait,
        Resources\SoftDeleteControllerTrait,
        Resources\AdminControllerTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  Announcement\Requests\AnnouncementRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(AnnouncementRequest $request)
    {
        $announcement = new Announcement();
        $announcement->title = $request->input('title');
        $announcement->body = $request->input('body');
        $announcement->save();

        return back();
    }
}
