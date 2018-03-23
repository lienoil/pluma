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
        'name' =>  'announcements.index',
        'code' => 'view-announcement',
        'description' => 'Ability to view list of announcements',
        'group' => 'announcement',
    ],
    'show-announcement' => [
        'name' => 'announcements.show',
        'code' => 'show-announcement',
        'description' => 'Ability to show a single announcement',
        'group' => 'announcement',
    ],
    'create-announcement' => [
        'name' => 'announcements.create',
        'code' => 'create-announcement',
        'description' => 'Ability to show the form to create announcement',
        'group' => 'announcement',
    ],
    'store-announcement' => [
        'name' => 'announcements.store',
        'code' => 'store-announcement',
        'description' => 'Ability to save the announcement',
        'group' => 'announcement',
    ],
    'edit-announcement' => [
        'name' => 'announcements.edit',
        'code' => 'edit-announcement',
        'description' => 'Ability to show the form to edit announcement',
        'group' => 'announcement',
    ],
    'update-announcement' => [
        'name' => 'announcements.update',
        'code' => 'update-announcement',
        'description' => 'Ability to update the announcement',
        'group' => 'announcement',
    ],
    'destroy-announcement' => [
        'name' =>  'announcements.destroy',
        'code' => 'destroy-announcement',
        'description' => 'Ability to move the announcement to trash',
        'group' => 'announcement',
    ],
    'delete-announcement' => [
        'name' =>  'announcements.delete',
        'code' => 'delete-announcement',
        'description' => 'Ability to permanently delete the announcement',
        'group' => 'announcement',
    ],
    'trashed-announcement' => [
        'name' =>  'announcements.trashed',
        'code' => 'trashed-announcement',
        'description' => 'Ability to view the list of all trashed announcement',
        'group' => 'announcement',
    ],
    'restore-announcement' => [
        'name' => 'announcements.restore',
        'code' => 'restore-announcement',
        'description' => 'Ability to restore the announcement',
        'group' => 'announcement',
    ],
];
