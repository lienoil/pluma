<?php

namespace Test\Controllers;

use Catalogue\Models\Catalogue;
use Category\Models\Category;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Library\Models\Library;
use Test\Models\Test;
use Test\Requests\TestRequest;

class TestController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $form = \Form\Models\Form::find(3);
        // $form = new \Form\Support\Builder\FormBuilder($form, $form->fields, 'Theme::templates.test');
        // [
        //     ['template' => '<v-text-field v-model="resource.item.asked" :error-messages="errors.asked" name="%name%" label="%label%"></v-text-field>', 'code' => '12qw', 'label' => 'What is asked?', 'name' => 'asked'],
        //     ['template' => '<v-text-field v-model="resource.item.givens" :error-messages="errors.givens" name="%name%" label="%label%"></v-text-field>', 'code' => '12s', 'label' => 'What are the given variables', 'name' => 'givens'],
        //     ['template' => '<v-text-field v-model="resource.item.operation" :error-messages="errors.operation" name="%name%" label="%label%"></v-text-field>', 'code' => '121x', 'label' => 'What operations should be used', 'name' => 'operation'],
        //     ['template' => '<v-text-field v-model="resource.item.result" :error-messages="errors.result" name="%name%" label="%label%"></v-text-field>', 'code' => '125x', 'label' => 'What operations should be used', 'name' => 'result'],
        // ]
        // $form->setFields([
        //     ['name' => 'What is asked?', 'sort' => 99],
        //     ['name' => 'What are the given variables?', 'sort' => 20],
        //     ['name' => 'What operations should be used?', 'sort' =>1],
        //     ['name' => 'What operations should be used 22?', 'sort' =>2],
        // ])
        // $form->setTemplatePath('Test::templates.test');
        // $form = $form->build('Test::templates.test');


        return view("Theme::tests.index")->with(compact('form'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::tests.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resource = \Form\Models\Form::find(1);

        return view("Theme::tests.create")->with(compact('resource'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        echo "<pre>";
            var_dump( $request->all() ); die();
        echo "</pre>";

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::tests.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('tests.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::tests.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(TestRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Test\Requests\TestRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(TestRequest $request, $id)
    {
        //

        return redirect()->route('tests.trash');
    }
}
