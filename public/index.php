<?php
/**
 * Pluma - A Web CMS
 *
 * @package  Pluma
 * @author   John Lioneil P. Dionisio <john.dionisio1@gmail.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. Code below will require it into the script here so that
| we don't have to worry about manual loading any of our classes later on.
|
*/

require __DIR__.'/../bootstrap/reporting.php';
require __DIR__.'/../bootstrap/autoload.php';

/*
|--------------------------------------------------------------------------
| App
|--------------------------------------------------------------------------
|
| Get the app instance.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->start();
