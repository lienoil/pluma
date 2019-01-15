<?php

namespace Category\Controllers\Resources;

use Category\Requests\CategoryRequest;
use Illuminate\Http\Request;

trait CategoryResourceAdminTrait
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $repository = $this->repository;
        $resources = $this->repository
            ->search($request->all())
            ->paginate();

        return view("{$this->hintpath}::{$this->folder}.index")->with(compact('resources', 'repository'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Category\Requests\CategoryRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());

        return back();
    }
}
