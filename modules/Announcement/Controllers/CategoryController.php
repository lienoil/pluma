<?php

namespace Announcement\Controllers;

use Category\Controllers\CategoryController as BaseCategoryController;

class CategoryController extends BaseCategoryController
{
    /**
     * The view hintpath.
     *
     * @var string
     */
    protected $hintpath = 'Announcement';

    /**
     * The category type of the resource.
     *
     * @var string
     */
    protected $type = 'announcements';
}
