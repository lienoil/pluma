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
     * Octocat Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-octocat' => [
        'name' => 'view-octocat',
        'code' => 'octocats.index',
        'description' => 'Ability to view list of octocats',
        'group' => 'octocat',
    ],
    'show-octocat' => [
        'name' => 'show-octocat',
        'code' => 'octocats.show',
        'description' => 'Ability to show a single octocat',
        'group' => 'octocat',
    ],
    'create-octocat' => [
        'name' => 'create-octocat',
        'code' => 'octocats.create',
        'description' => 'Ability to show the form to create octocat',
        'group' => 'octocat',
    ],
    'store-octocat' => [
        'name' => 'store-octocat',
        'code' => 'octocats.store',
        'description' => 'Ability to save the octocat',
        'group' => 'octocat',
    ],
    'edit-octocat' => [
        'name' => 'edit-octocat',
        'code' => 'octocats.edit',
        'description' => 'Ability to show the form to edit octocat',
        'group' => 'octocat',
    ],
    'update-octocat' => [
        'name' => 'update-octocat',
        'code' => 'octocats.update',
        'description' => 'Ability to update the octocat',
        'group' => 'octocat',
    ],
    'destroy-octocat' => [
        'name' =>  'destroy-octocat',
        'code' => 'octocats.destroy',
        'description' => 'Ability to move the octocat to trash',
        'group' => 'octocat',
    ],
    'delete-octocat' => [
        'name' =>  'delete-octocats',
        'code' => 'octocats.deletes',
        'description' => 'Ability to permanently delete the octocat',
        'group' => 'octocat',
    ],
    'trashed-octocat' => [
        'name' => 'trashed-octocat',
        'code' => 'octocats.trashed',
        'description' => 'Ability to view the list of all trashed octocat',
        'group' => 'octocat',
    ],
    'restore-octocat' => [
        'name' => 'restore-octocat',
        'code' => 'octocats.restore',
        'description' => 'Ability to restore the octocat',
        'group' => 'octocat',
    ],
];
