<?php
/**
 *------------------------------------------------------------------------------
 * Permissions Array
 *------------------------------------------------------------------------------
 *
 * Here we define our permissions that you can attach to roles.
 *
 * These permissions corresponds to a counterpart
 * route (found in <this module>/routes/<route-files>.php).
 * All permissionable routes should have a `name` (e.g. 'roles.store')
 * for the role authentication middleware to work.
 *
 */
return [
    /**
     *--------------------------------------------------------------------------
     * $name Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-blogs' => [
        'name' =>  'view-blogs',
        'code' => 'blogs.index',
        'description' => 'Ability to view list of blogs',
        'group' => 'blog',
    ],
    'show-blog' => [
        'name' => 'show-blog',
        'code' => 'blogs.show',
        'description' => 'Ability to show a single blog',
        'group' => 'blog',
    ],
    'create-blog' => [
        'name' => 'create-blog',
        'code' => 'blogs.create',
        'description' => 'Ability to create new blog',
        'group' => 'blog',
    ],
    'store-blog' => [
        'name' => 'store-blog',
        'code' => 'blogs.store',
        'description' => 'Ability to save the blog',
        'group' => 'blog',
    ],
    'update-blog' => [
        'name' => 'update-blog',
        'code' => 'blogs.update',
        'description' => 'Ability to update the blog',
        'group' => 'blog',
    ],
    'destroy-blog' => [
        'name' => 'destroy-blog',
        'code' =>  'blogs.destroy',
        'description' => 'Ability to move the blog to trash',
        'group' => 'blog',
    ],
    'delete-blog' => [
        'name' => 'delete-blog',
        'code' =>  'blogs.delete',
        'description' => 'Ability to permanently delete the blog',
        'group' => 'blog',
    ],
    'trashed-blogs' => [
        'name' => 'trashed-blogs',
        'code' =>  'blogs.trashed',
        'description' => 'Ability to view the list of all trashed blogs',
        'group' => 'blog',
    ],
    'restore-blog' => [
        'name' => 'restore-blog',
        'code' => 'blogs.restore',
        'description' => 'Ability to restore the blog from trash',
        'group' => 'blog',
    ],
];
