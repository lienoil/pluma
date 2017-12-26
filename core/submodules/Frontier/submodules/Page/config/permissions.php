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
    'view-page' => [
        'name' =>  'pages.index',
        'code' => 'view-page',
        'description' => 'Ability to view list of pages',
        'group' => 'page',
    ],
    'show-page' => [
        'name' => 'pages.show',
        'code' => 'show-page',
        'description' => 'Ability to show a single page',
        'group' => 'page',
    ],
    'create-page' => [
        'name' => 'pages.create',
        'code' => 'create-page',
        'description' => 'Ability to show the form to create page',
        'group' => 'page',
    ],
    'store-page' => [
        'name' => 'pages.store',
        'code' => 'store-page',
        'description' => 'Ability to save the page',
        'group' => 'page',
    ],
    'edit-page' => [
        'name' => 'pages.edit',
        'code' => 'edit-page',
        'description' => 'Ability to show the form to edit page',
        'group' => 'page',
    ],
    'update-page' => [
        'name' => 'pages.update',
        'code' => 'update-page',
        'description' => 'Ability to update the page',
        'group' => 'page',
    ],
    'destroy-page' => [
        'name' =>  'pages.destroy',
        'code' => 'destroy-page',
        'description' => 'Ability to move the page to trash',
        'group' => 'page',
    ],
    'trashed-page' => [
        'name' =>  'pages.trashed',
        'code' => 'trashed-page',
        'description' => 'Ability to view the list of all trashed page',
        'group' => 'page',
    ],
    'delete-page' => [
        'name' =>  'pages.delete',
        'code' => 'delete-page',
        'description' => 'Ability to permanently delete the page',
        'group' => 'page',
    ],
    'restore-page' => [
        'name' => 'pages.restore',
        'code' => 'restore-page',
        'description' => 'Ability to restore the page',
        'group' => 'page',
    ],
];
