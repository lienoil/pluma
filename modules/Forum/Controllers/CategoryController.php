<?php

namespace Forum\Controllers;

use Category\Controllers\CategoryController as BaseCategoryController;

class CategoryController extends BaseCategoryController
{
    /**
     * The view hintpath.
     *
     * @var string
     */
    protected $hintpath = 'Forum';

    /**
     * The category type of the resource.
     *
     * @var string
     */
    protected $type = 'forums';
}
