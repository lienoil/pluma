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
        'name' => 'octocats.index',
        'code' => 'view-octocat',
        'description' => 'Ability to view list of octocats',
        'group' => 'octocat',
    ],
    'show-octocat' => [
        'name' => 'octocats.show',
        'code' => 'show-octocat',
        'description' => 'Ability to show a single octocat',
        'group' => 'octocat',
    ],
    'create-octocat' => [
        'name' => 'octocats.create',
        'code' => 'create-octocat',
        'description' => 'Ability to show the form to create octocat',
        'group' => 'octocat',
    ],
    'store-octocat' => [
        'name' => 'octocats.store',
        'code' => 'store-octocat',
        'description' => 'Ability to save the octocat',
        'group' => 'octocat',
    ],
    'edit-octocat' => [
        'name' => 'octocats.edit',
        'code' => 'edit-octocat',
        'description' => 'Ability to show the form to edit octocat',
        'group' => 'octocat',
    ],
    'update-octocat' => [
        'name' => 'octocats.update',
        'code' => 'update-octocat',
        'description' => 'Ability to update the octocat',
        'group' => 'octocat',
    ],
    'destroy-octocat' => [
        'name' =>  'octocats.destroy',
        'code' => 'destroy-octocat',
        'description' => 'Ability to move the octocat to trash',
        'group' => 'octocat',
    ],
    'delete-octocat' => [
        'name' =>  'octocats.delete',
        'code' => 'delete-octocat',
        'description' => 'Ability to permanently delete the octocat',
        'group' => 'octocat',
    ],
    'trashed-octocat' => [
        'name' => 'octocats.trashed',
        'code' => 'trashed-octocat',
        'description' => 'Ability to view the list of all trashed octocat',
        'group' => 'octocat',
    ],
    'restore-octocat' => [
        'name' => 'octocats.restore',
        'code' => 'restore-octocat',
        'description' => 'Ability to restore the octocat',
        'group' => 'octocat',
    ],
];
