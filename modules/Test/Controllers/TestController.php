<?php

namespace Test\Controllers;

use Frontier\Controllers\GeneralController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Test\Models\Test;
use Test\Requests\TestRequest;

class TestController extends GeneralController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $course = \Course\Models\Course::first();
        $c = $course->lessons()->root();
        // dd($c);

        // $faker = \Faker\Factory::create();
        // $lesson = [];
        // $lesson['title'] = $title = str_replace('.', '', ucwords($faker->realText(40, 4)));
        // $lesson['slug'] = $slug = str_slug($title);
        // $lesson['code'] = $code = $faker->swiftBicNumber;
        // $lesson['feature'] = $faker->imageUrl(300, 300);
        // $lesson['body'] = $body = $faker->paragraph;
        // $course->lessons()->updateOrCreate(['code' => $lesson['code']], $lesson);
        // foreach ($course->lessons as $lesson) {
            // $lesson = $course->lessons()->find(2);
            $sqlX = "
                INSERT INTO `lessonstree` (`ancestor`, `descendant`, `length`)
                SELECT t.ancestor, 3, t.length + 1
                FROM `lessonstree` AS t
                WHERE t.descendant = 2
                UNION ALL
                SELECT 3, 3, 0
            ";
            // DB::select($sqlX);
        //     // $lesson->lineage()->select($sqlX)->execute();
        // }

        // $sql = "
        //     SELECT c.* FROM `lessons` AS c
        //         JOIN `lessonstree` AS t
        //             ON (c.id = t.descendant)
        //         WHERE t.ancestor = 4
        // ";
        // dd($c);

        return view("Theme::tests.index")->with(['resources' => $c]);
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
        //

        return view("Theme::tests.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::tests.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @return Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        //

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::tests.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Test\Requests\TestRequest  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(TestRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return back();
    }
}
