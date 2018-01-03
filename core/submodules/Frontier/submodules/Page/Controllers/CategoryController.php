<?php

namespace Page\Controllers;

use Category\Controllers\CategoryController as BaseCategoryController;

class CategoryController extends BaseCategoryController
{
    /**
     * The view hintpath.
     *
     * @var string
     */
    protected $hintpath = 'Page';

    /**
     * The category type of the resource.
     *
     * @var string
     */
    protected $type = 'pages';
}
