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
    'view-comment' => [
        'name' =>  'view-comment',
        'code' => 'comments.index',
        'description' => 'Ability to view list of comments',
        'group' => 'comment',
    ],
    'show-comment' => [
        'name' => 'show-comment',
        'code' => 'comments.show',
        'description' => 'Ability to show a single comment',
        'group' => 'comment',
    ],
    'store-comment' => [
        'name' => 'store-comment',
        'code' => 'comments.store',
        'description' => 'Ability to save the comment',
        'group' => 'comment',
    ],
    'post-comment' => [
        'name' => 'post-comment',
        'code' => 'comments.post',
        'description' => 'Ability to save the comment',
        'group' => 'comment',
    ],
    'edit-comment' => [
        'name' => 'edit-comment',
        'code' => 'comments.edit',
        'description' => 'Ability to show the form to edit comment',
        'group' => 'comment',
    ],
    'update-comment' => [
        'name' => 'update-comment',
        'code' => 'comments.update',
        'description' => 'Ability to update the comment',
        'group' => 'comment',
    ],
    'destroy-comment' => [
        'name' =>  'destroy-comment',
        'code' => 'comments.destroy',
        'description' => 'Ability to move the comment to trash',
        'group' => 'comment',
    ],
    'trashed-comment' => [
        'name' =>  'trashed-comment',
        'code' => 'comments.trashed',
        'description' => 'Ability to view the list of all trashed comment',
        'group' => 'comment',
    ],
    'delete-comment' => [
        'name' =>  'delete-comment',
        'code' => 'comments.delete',
        'description' => 'Ability to permanently delete the comment',
        'group' => 'comment',
    ],
    'restore-comment' => [
        'name' => 'restore-comment',
        'code' => 'comments.restore',
        'description' => 'Ability to restore the comment',
        'group' => 'comment',
    ],
];
