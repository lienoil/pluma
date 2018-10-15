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
    'view-contents' => [
        'name' =>  'view-contents',
        'code' => 'contents.index',
        'description' => 'Ability to view list of contents',
        'group' => 'content',
    ],
    'show-content' => [
        'name' => 'show-content',
        'code' => 'contents.show',
        'description' => 'Ability to show a single content',
        'group' => 'content',
    ],
    'create-content' => [
        'name' => 'create-content',
        'code' => 'contents.create',
        'description' => 'Ability to create new content',
        'group' => 'content',
    ],
    'store-content' => [
        'name' => 'store-content',
        'code' => 'contents.store',
        'description' => 'Ability to save the content',
        'group' => 'content',
    ],
    'edit-content' => [
        'name' => 'store-content',
        'code' => 'contents.store',
        'description' => 'Ability to show the form to edit content',
        'group' => 'content',
    ],
    'update-content' => [
        'name' => 'update-content',
        'code' => 'contents.update',
        'description' => 'Ability to update the content',
        'group' => 'content',
    ],
    'destroy-content' => [
        'name' => 'destroy-content',
        'code' =>  'contents.destroy',
        'description' => 'Ability to move the content to trash',
        'group' => 'content',
    ],
    'delete-content' => [
        'name' => 'delete-content',
        'code' =>  'contents.delete',
        'description' => 'Ability to permanently delete the content',
        'group' => 'content',
    ],
    'trashed-contents' => [
        'name' => 'trashed-contents',
        'code' =>  'contents.trashed',
        'description' => 'Ability to view the list of all trashed contents',
        'group' => 'content',
    ],
    'restore-content' => [
        'name' => 'restore-content',
        'code' => 'contents.restore',
        'description' => 'Ability to restore the content from trash',
        'group' => 'content',
    ],

    // Many
    'destroy-many-content' => [
        'name' => 'destroy-many-content',
        'code' => 'contents.many.destroy',
        'description' => 'Ability to destroy many contents',
        'group' => 'content',
    ],
    'delete-many-content' => [
        'name' => 'delete-many-content',
        'code' => 'contents.many.destroy',
        'description' => 'Ability to permanently delete many contents',
        'group' => 'content',
    ],
    'restore-many-content' => [
        'name' => 'restore-many-content',
        'code' => 'contents.many.restore',
        'description' => 'Ability to restore many contents',
        'group' => 'content',
    ],
];
