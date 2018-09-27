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
     * Theme Permissions
     * -------------------------------------------------------------------------
     *
     */
    'view-theme' => [
        'name' =>  'view-theme',
        'code' => 'themes.index',
        'description' => 'Ability to view list of themes',
        'group' => 'theme, appearance',
    ],
    'show-theme' => [
        'name' => 'show-theme',
        'code' => 'themes.show',
        'description' => 'Ability to show a single theme',
        'group' => 'theme, appearance',
    ],
    'create-theme' => [
        'name' => 'create-theme',
        'code' => 'themes.create',
        'description' => 'Ability to show the form to create theme',
        'group' => 'theme, appearance',
    ],
    'store-theme' => [
        'name' => 'store-theme',
        'code' => 'themes.store',
        'description' => 'Ability to save the theme',
        'group' => 'theme, appearance',
    ],
    'edit-theme' => [
        'name' => 'edit-theme',
        'code' => 'themes.edit',
        'description' => 'Ability to show the form to edit theme',
        'group' => 'theme, appearance',
    ],
    'update-theme' => [
        'name' => 'update-theme',
        'code' => 'themes.update',
        'description' => 'Ability to update the theme',
        'group' => 'theme, appearance',
    ],
    'destroy-theme' => [
        'name' =>  'destroy-theme',
        'code' => 'themes.destroy',
        'description' => 'Ability to move the theme to trash',
        'group' => 'theme, appearance',
    ],
    'delete-theme' => [
        'name' =>  'delete-theme',
        'code' => 'themes.delete',
        'description' => 'Ability to permanently delete the theme',
        'group' => 'theme, appearance',
    ],
    'trash-theme' => [
        'name' =>  'trash-theme',
        'code' => 'themes.trash',
        'description' => 'Ability to view the list of all trashed theme',
        'group' => 'theme, appearance',
    ],
    'restore-theme' => [
        'name' => 'restore-theme',
        'code' => 'themes.restore',
        'description' => 'Ability to restore the theme',
        'group' => 'theme, appearance',
    ],

    // Many
    'destroy-many-theme' => [
        'name' =>  'destroy-many-theme',
        'code' => 'themes.many.destroy',
        'description' => 'Ability to destroy many themes',
        'group' => 'theme, appearance',
    ],
    'delete-many-theme' => [
        'name' =>  'delete-many-theme',
        'code' => 'themes.many.delete',
        'description' => 'Ability to permanently delete many themes',
        'group' => 'theme, appearance',
    ],
    'restore-many-theme' => [
        'name' => 'restore-many-theme',
        'code' => 'themes.many.restore',
        'description' => 'Ability to restore many themes',
        'group' => 'theme, appearance',
    ],

    //
];
