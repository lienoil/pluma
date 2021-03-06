<?php

const PLUMA_VERSION = '2.0.1';

define('PLUMA_START', microtime(true));

/**
 *------------------------------------------------------------------------------
 * Register The Composer Auto Loader
 *------------------------------------------------------------------------------
 *
 * Composer provides a convenient, automatically generated class loader
 * for our application. We just need to utilize it! We'll require it
 * into the script here so we do not have to manually load any of
 * our application's PHP classes. It just feels great to relax.
 *
 */

require realpath(__DIR__ . '/../vendor/autoload.php');
require realpath(__DIR__ . '/../core/helpers/helpers.php');
require realpath(__DIR__ . '/../core/helpers/functions.php');

$compiledPath = realpath(__DIR__ . '/cache/compiled.php');

if (file_exists($compiledPath)) {
    require $compiledPath;
}
