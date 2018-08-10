<?php

namespace Course\API\Controllers;

use Pluma\API\Controllers\APIController;

class MyCourseController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        /**
         * Use the Course\Models\User instead
         * of the default User\Models\User.
         * In this way we have access to the course_user relationship.
         *
         * @var  \Course\Models\User $user
         */
        $user = User::find(user()->id);
        $resources = $user->courses;

        return response()->json($resources);
    }
}
