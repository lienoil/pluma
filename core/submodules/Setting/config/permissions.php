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
    'view-setting' => [
        'name' =>  'view-setting',
        'code' => 'settings.index',
        'description' => 'Ability to view list of settings',
        'group' => 'setting',
    ],
    'show-setting' => [
        'name' => 'show-setting',
        'code' => 'settings.show',
        'description' => 'Ability to show a single setting',
        'group' => 'setting',
    ],
    'create-setting' => [
        'name' => 'create-setting',
        'code' => 'settings.create',
        'description' => 'Ability to show the form to create setting',
        'group' => 'setting',
    ],
    'store-setting' => [
        'name' => 'store-setting',
        'code' => 'settings.store',
        'description' => 'Ability to save the setting',
        'group' => 'setting',
    ],
    'edit-setting' => [
        'name' => 'edit-setting',
        'code' => 'settings.edit',
        'description' => 'Ability to show the form to edit setting',
        'group' => 'setting',
    ],
    'update-setting' => [
        'name' => 'update-setting',
        'code' => 'settings.update',
        'description' => 'Ability to update the setting',
        'group' => 'setting',
    ],
    'destroy-setting' => [
        'name' =>  'destroy-setting',
        'code' => 'settings.destroy',
        'description' => 'Ability to move the setting to trash',
        'group' => 'setting',
    ],
    'delete-setting' => [
        'name' =>  'delete-setting',
        'code' => 'settings.delete',
        'description' => 'Ability to permanently delete the setting',
        'group' => 'setting',
    ],
    'trash-setting' => [
        'name' =>  'trash-setting',
        'code' => 'settings.trash',
        'description' => 'Ability to view the list of all trashed setting',
        'group' => 'setting',
    ],
    'restore-setting' => [
        'name' => 'restore-setting',
        'code' => 'settings.restore',
        'description' => 'Ability to restore the setting',
        'group' => 'setting',
    ],

    /**
     *--------------------------------------------------------------------------
     * Settings
     *--------------------------------------------------------------------------
     *
     */
    'general-settings' => [
        'name' =>  'general-settings',
        'code' => 'settings.general',
        'description' => 'Ability to view list of general settings',
        'group' => 'setting, appearance',
    ],

    'display-settings' => [
        'name' =>  'display-settings',
        'code' => 'settings.display',
        'description' => 'Ability to view list of display settings',
        'group' => 'setting, appearance',
    ],

    'branding-settings' => [
        'name' =>  'branding-settings',
        'code' => 'settings.branding',
        'description' => 'Ability to view list of branding settings',
        'group' => 'setting, appearance',
    ],

    'social-media-settings' => [
        'name' =>  'social-media-settings',
        'code' => 'settings.social',
        'description' => 'Ability to view list of social media settings',
        'group' => 'setting, appearance',
    ],

    'themes-settings' => [
        'name' =>  'themes-settings',
        'code' => 'settings.themes',
        'description' => 'Ability to view list of themes settings',
        'group' => 'setting, appearance',
    ],
];
