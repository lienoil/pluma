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
     * By default, the application will check these arrays if the file requested
     * for download is not restricted.
     *
     */
    'restricted' => [
        'php',
        'env',
    ],
];
