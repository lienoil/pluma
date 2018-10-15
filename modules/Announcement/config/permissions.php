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
     * Announcement Permissions
     *
     */
    'view-announcement' => [
        'name' =>  'view-announcement',
        'code' => 'announcements.index',
        'description' => 'Ability to view list of announcements',
        'group' => 'announcement',
    ],
    'show-announcement' => [
        'name' => 'show-announcement',
        'code' => 'announcements.show',
        'description' => 'Ability to show a single announcement',
        'group' => 'announcement',
    ],
    'create-announcement' => [
        'name' => 'create-announcement',
        'code' => 'announcements.create',
        'description' => 'Ability to show the form to create announcement',
        'group' => 'announcement',
    ],
    'store-announcement' => [
        'name' => 'store-announcement',
        'code' => 'announcements.store',
        'description' => 'Ability to save the announcement',
        'group' => 'announcement',
    ],
    'edit-announcement' => [
        'name' => 'edit-announcement',
        'code' => 'announcements.edit',
        'description' => 'Ability to show the form to edit announcement',
        'group' => 'announcement',
    ],
    'update-announcement' => [
        'name' => 'update-announcement',
        'code' => 'announcements.update',
        'description' => 'Ability to update the announcement',
        'group' => 'announcement',
    ],
    'destroy-announcement' => [
        'name' =>  'destroy-announcement',
        'code' => 'announcements.destroy',
        'description' => 'Ability to move the announcement to trash',
        'group' => 'announcement',
    ],
    'delete-announcement' => [
        'name' =>  'delete-announcement',
        'code' => 'announcements.deletedelete-announcement',
        'description' => 'Ability to permanently delete the announcement',
        'group' => 'announcement',
    ],
    'trashed-announcement' => [
        'code' => 'announcements.trashed',
        'name' =>  'trashed-announcement',
        'description' => 'Ability to view the list of all trashed announcement',
        'group' => 'announcement',
    ],
    'restore-announcement' => [
        'name' => 'restore-announcement',
        'code' => 'announcements.restore',
        'description' => 'Ability to restore the announcement',
        'group' => 'announcement',
    ],
];
