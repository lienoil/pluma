<?php

return [
    /**
     *--------------------------------------------------------------------------
     * Allowed File Extensions
     *--------------------------------------------------------------------------
     *
     * Array of downloadable files.
     * The application, by default, is using the 'restricted' key for checking
     * if a file is allowed.
     *
     */
    'allowed' => [
        // 'html', 'swf'
    ],

    /**
     *--------------------------------------------------------------------------
     * Restricted File Extensions
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
