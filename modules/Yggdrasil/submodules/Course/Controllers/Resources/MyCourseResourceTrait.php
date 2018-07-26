<?php

namespace Course\Controllers\Resources;

use Illuminate\Http\Request;

trait MyCourseResourceTrait
{
    /**
     * Retrieve list of all resources
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function current(Request $request)
    {
        $resources = Student::findOrFail(user()->id)
    }
}
