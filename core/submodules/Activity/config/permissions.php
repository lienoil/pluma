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
     * -------------------------------------------------------------------------
     * Activity Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-activity' => [
        'name' => 'view-activity',
        'code' => 'activities.index',
        'description' => 'Ability to view list of activities',
        'group' => 'activity',
    ],
    'show-activity' => [
        'name' => 'show-activity',
        'code' => 'activities.show',
        'description' => 'Ability to show a single activity',
        'group' => 'activity',
    ],
    'create-activity' => [
        'name' => 'create-activity',
        'code' => 'activities.create',
        'description' => 'Ability to show the form to create activity',
        'group' => 'activity',
    ],
    'store-activity' => [
        'name' => 'store-activity',
        'code' => 'activities.store',
        'description' => 'Ability to save the activity',
        'group' => 'activity',
    ],
    'edit-activity' => [
        'name' => 'edit-activity',
        'code' => 'activities.edit',
        'description' => 'Ability to show the form to edit activity',
        'group' => 'activity',
    ],
    'update-activity' => [
        'name' => 'update-activity',
        'code' => 'activities.update',
        'description' => 'Ability to update the activity',
        'group' => 'activity',
    ],
    'destroy-activity' => [
        'name' =>  'destroy-activity',
        'code' => 'activities.destroy',
        'description' => 'Ability to move the activity to trash',
        'group' => 'activity',
    ],
    'delete-activity' => [
        'name' =>  'delete-activity',
        'code' => 'activities.delete',
        'description' => 'Ability to permanently delete the activity',
        'group' => 'activity',
    ],
    'trashed-activity' => [
        'name' => 'trashed-activity',
        'code' => 'activities.trashed',
        'description' => 'Ability to view the list of all trashed activity',
        'group' => 'activity',
    ],
    'restore-activity' => [
        'name' => 'restore-activity',
        'code' => 'activities.restore',
        'description' => 'Ability to restore the activity',
        'group' => 'activity',
    ],
];
