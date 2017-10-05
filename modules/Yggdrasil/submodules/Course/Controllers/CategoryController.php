<?php

namespace Course\Controllers;

class CategoryController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = Category::where('categorable_type');

        return view("Theme::courses.index")->with(compact('courses'));
    }
}
