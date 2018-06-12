<?php

namespace Task\Controllers;

use Task\Models\Task;
use Task\Requests\TaskRequest;
use Task\Controllers\Resources\TaskResourceAdminTrait;
use Task\Controllers\Resources\TaskResourceApiTrait;
use Task\Controllers\Resources\TaskResourceSoftDeletesTrait;
use Task\Controllers\Resources\TaskResourcePublicTrait;
use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;

class TaskController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Task::search($request->all())->paginate();

        return view("Task::tasks.index")->with(compact('resources'));
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
        $resource = Task::findOrFail($id);

        return view("Task::tasks.show")->with(compact('resource'));
    }
}
