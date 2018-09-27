<?php

/**
 * -----------------------------------------------------------------------------
 * Permissions Array
 * -----------------------------------------------------------------------------
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
     * -------------------------------------------------------------------------
     * Category Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-category' => [
        'name' =>  'view-category',
        'code' => 'categories.index',
        'description' => 'Ability to view list of categories',
        'group' => 'category',
    ],
    'show-category' => [
        'name' => 'show-category',
        'code' => 'categories.show',
        'description' => 'Ability to show a single category',
        'group' => 'category',
    ],
    'create-category' => [
        'name' => 'create-category',
        'code' => 'categories.create',
        'description' => 'Ability to show the form to create category',
        'group' => 'category',
    ],
    'store-category' => [
        'name' => 'store-category',
        'code' => 'categories.store',
        'description' => 'Ability to save the category',
        'group' => 'category',
    ],
    'edit-category' => [
        'name' => 'edit-category',
        'code' => 'categories.edit',
        'description' => 'Ability to show the form to edit category',
        'group' => 'category',
    ],
    'update-category' => [
        'name' => 'update-category',
        'code' => 'categories.update',
        'description' => 'Ability to update the category',
        'group' => 'category',
    ],
    'destroy-category' => [
        'name' =>  'destroy-category',
        'code' => 'categories.destroy',
        'description' => 'Ability to move the category to trash',
        'group' => 'category',
    ],
    'delete-category' => [
        'name' =>  'delete-category',
        'code' => 'categories.delete',
        'description' => 'Ability to permanently delete the category',
        'group' => 'category',
    ],
    'trash-category' => [
        'name' =>  'trash-category',
        'code' => 'categories.trash',
        'description' => 'Ability to view the list of all trashed category',
        'group' => 'category',
    ],
    'restore-category' => [
        'name' => 'restore-category',
        'code' => 'categories.restore',
        'description' => 'Ability to restore the category',
        'group' => 'category',
    ],

    // Many
    'destroy-many-category' => [
        'name' =>  'destroy-many-category',
        'code' => 'categories.many.destroy',
        'description' => 'Ability to destroy many categories',
        'group' => 'category',
    ],
    'delete-many-category' => [
        'name' =>  'delete-many-category',
        'code' => 'categories.many.delete',
        'description' => 'Ability to permanently delete many categories',
        'group' => 'category',
    ],
    'restore-many-category' => [
        'name' => 'restore-many-category',
        'code' => 'categories.many.restore',
        'description' => 'Ability to restore many categories',
        'group' => 'category',
    ],

    //
];
