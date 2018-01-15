<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Allowed Files
     *--------------------------------------------------------------------------
     *
     * Array of downloadable files.
     * Pluma, by default, is only using the key 'restricted' for checking if 
     * file is allowed as checking in the `allowed` key takes longer.
     * Leaving this empty is relatively safe.
     * 
     */
    'allowed' => [
        //
    ],

    /**
     *--------------------------------------------------------------------------
     * Restricted Files
     *--------------------------------------------------------------------------
     *
     * Non-downloadable files.
     * Pluma, by default, will only use this to check if file is downloadable as
     * this is is shorter.
     * 
     */
    'restricted' => [
        'php',
        'html',
        'env',
    ],
];
