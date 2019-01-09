<?php

namespace Form\Controllers\Resources;

use Illuminate\Http\Request;
use Template\Models\Template;
use Fieldtype\Models\Fieldtype;

trait FormResourceAdminTrait
{
    /**
     * Show list of resources.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = $this->repository->search($request->all())->paginate();

        return view('Form::admin.index')->with(compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates = Template::getTemplatesFromFiles();
        $fieldtypes = Fieldtype::all();

        return view('Form::admin.create')->with(compact('fieldtypes', 'templates'));
    }
}
