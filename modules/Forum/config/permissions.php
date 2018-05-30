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
     * Forum Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-forum' => [
        'name' =>  'forums.index',
        'code' => 'view-forum',
        'description' => 'Ability to view list of forums',
        'group' => 'forum, public-forum',
    ],
    'show-forum' => [
        'name' => 'forums.show',
        'code' => 'show-forum',
        'description' => 'Ability to show a single forum',
        'group' => 'forum, public-forum',
    ],
    'create-forum' => [
        'name' => 'forums.create',
        'code' => 'create-forum',
        'description' => 'Ability to show the form to create forum',
        'group' => 'forum, public-forum',
    ],
    'store-forum' => [
        'name' => 'forums.store',
        'code' => 'store-forum',
        'description' => 'Ability to save the forum',
        'group' => 'forum',
    ],
    'edit-forum' => [
        'name' => 'forums.edit',
        'code' => 'edit-forum',
        'description' => 'Ability to show the form to edit forum',
        'group' => 'forum',
    ],
    'update-forum' => [
        'name' => 'forums.update',
        'code' => 'update-forum',
        'description' => 'Ability to update the forum',
        'group' => 'forum',
    ],
    'destroy-forum' => [
        'name' =>  'forums.destroy',
        'code' => 'destroy-forum',
        'description' => 'Ability to move the forum to trash',
        'group' => 'forum',
    ],
    'trashed-forum' => [
        'name' =>  'forums.trashed',
        'code' => 'trashed-forum',
        'description' => 'Ability to view the list of all trashed forum',
        'group' => 'forum',
    ],
    'delete-forum' => [
        'name' =>  'forums.delete',
        'code' => 'delete-forum',
        'description' => 'Ability to permanently delete the forum',
        'group' => 'forum',
    ],
    'restore-forum' => [
        'name' => 'forums.restore',
        'code' => 'restore-forum',
        'description' => 'Ability to restore the forum',
        'group' => 'forum',
    ],
    'comment-forum' => [
        'name' => 'forums.comment',
        'code' => 'comment-forum',
        'description' => 'Ability to comment to the forum',
        'group' => 'forum, comment-forum, comment',
    ],
];
