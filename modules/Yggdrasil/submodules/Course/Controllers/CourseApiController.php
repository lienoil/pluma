<?php

namespace Course\Controllers;

use Course\Models\Course;
use Course\Repositories\CourseRepository;
use Course\Resources\CourseCollection;
use Illuminate\Http\Request;
use Pluma\Controllers\ApiController;

class CourseApiController extends ApiController
{
    /**
     * The repository instance.
     *
     * @var \Pluma\Support\Repository\Repository
     */
    protected $repository = CourseRepository::class;

    /**
     * Retrieve list of resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        return new CourseCollection($this->repository->search($request->all())->paginate());
    }
}
