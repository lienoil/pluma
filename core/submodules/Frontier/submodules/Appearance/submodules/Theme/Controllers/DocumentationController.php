<?php

namespace Theme\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Theme\Models\Theme;
use Theme\Repositories\ThemeRepository;

class DocumentationController extends AdminController
{
    /**
     * Inject the resource model to the repository instance.
     *
     */
    public function __construct()
    {
        $this->repository = new ThemeRepository();

        parent::__construct();
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string  $theme
     * @param  string  $component
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $theme, $component)
    {
        $resource = Theme::themeOrFail($theme);
        $docs = $this->repository->docs();
        $content = $docs->only($component)->first() ?? abort(404);

        return view('Theme::documentations.show')->with(compact('resource', 'docs', 'content'));
    }
}
