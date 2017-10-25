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
     * Forum Permissions
     *
     */
    'view-forum' => [
        'name' =>  'forums.index',
        'code' => 'view-forum',
        'description' => 'Ability to view list of forums',
        'group' => 'forum',
    ],
    'show-forum' => [
        'name' => 'forums.show',
        'code' => 'show-forum',
        'description' => 'Ability to show a single forum',
        'group' => 'forum',
    ],
    'create-forum' => [
        'name' => 'forums.create',
        'code' => 'create-forum',
        'description' => 'Ability to show the form to create forum',
        'group' => 'forum',
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
    'delete-forum' => [
        'name' =>  'forums.delete',
        'code' => 'delete-forum',
        'description' => 'Ability to permanently delete the forum',
        'group' => 'forum',
    ],
    'trash-forum' => [
        'name' =>  'forums.trash',
        'code' => 'trash-forum',
        'description' => 'Ability to view the list of all trashed forum',
        'group' => 'forum',
    ],
    'restore-forum' => [
        'name' => 'forums.restore',
        'code' => 'restore-forum',
        'description' => 'Ability to restore the forum',
        'group' => 'forum',
    ],

    // Many
    'destroy-many-forum' => [
        'name' =>  'forums.many.destroy',
        'code' => 'destroy-many-forum',
        'description' => 'Ability to destroy many forums',
        'group' => 'forum',
    ],
    'delete-many-forum' => [
        'name' =>  'forums.many.delete',
        'code' => 'delete-many-forum',
        'description' => 'Ability to permanently delete many forums',
        'group' => 'forum',
    ],
    'restore-many-forum' => [
        'name' => 'forums.many.restore',
        'code' => 'restore-many-forum',
        'description' => 'Ability to restore many forums',
        'group' => 'forum',
    ],

    //
];
