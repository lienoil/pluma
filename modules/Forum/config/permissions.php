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
        'name' =>  'view-forum',
        'code' => 'forums.index',
        'description' => 'Ability to view list of forums',
        'group' => 'forum, public-forum',
    ],
    'show-forum' => [
        'name' => 'show-forum',
        'code' => 'forums.show',
        'description' => 'Ability to show a single forum',
        'group' => 'forum, public-forum',
    ],
    'create-forum' => [
        'name' => 'create-forum',
        'code' => 'forums.create',
        'description' => 'Ability to show the form to create forum',
        'group' => 'forum, public-forum',
    ],
    'store-forum' => [
        'name' => 'store-forum',
        'code' => 'forums.store',
        'description' => 'Ability to save the forum',
        'group' => 'forum',
    ],
    'edit-forum' => [
        'name' => 'edit-forum',
        'code' => 'forums.edit',
        'description' => 'Ability to show the form to edit forum',
        'group' => 'forum',
    ],
    'update-forum' => [
        'name' => 'update-forum',
        'code' => 'forums.update',
        'description' => 'Ability to update the forum',
        'group' => 'forum',
    ],
    'destroy-forum' => [
        'name' =>  'destroy-forum',
        'code' => 'forums.destroy',
        'description' => 'Ability to move the forum to trash',
        'group' => 'forum',
    ],
    'trashed-forum' => [
        'name' =>  'trashed-forum',
        'code' => 'forums.trashed',
        'description' => 'Ability to view the list of all trashed forum',
        'group' => 'forum',
    ],
    'delete-forum' => [
        'name' =>  'delete-forum',
        'code' => 'forums.delete',
        'description' => 'Ability to permanently delete the forum',
        'group' => 'forum',
    ],
    'restore-forum' => [
        'name' => 'restore-forum',
        'code' => 'forums.restore',
        'description' => 'Ability to restore the forum',
        'group' => 'forum',
    ],
    'comment-forum' => [
        'name' => 'comment-forum',
        'code' => 'forums.comment',
        'description' => 'Ability to comment to the forum',
        'group' => 'forum, comment-forum, comment',
    ],
];
