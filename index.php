<?php
/**
 * --------------------------------------------------------------------------
 * NOTICE
 * --------------------------------------------------------------------------
 * If you can't use the public/ folder as your Document Root, you may use
 * this file instead. Make sure you also have a .htaccess along side this
 * file.
 *
 * It is IMPORTANT to note that THIS IS LESS SECURE as the whole Pluma PHP Code
 * is beaming across the universe.
 *
 * You MIGHT need to put an index(.php||.html) on every folder just to make sure.
 * But nothing IS secure, anyway. If they wan't to view your site's files,
 * they WILL find a way. We are helpless in the face of the Leviathan. The great
 * void, unrelenting in its silence will someday finally whisper,
 * life is meaningless.
 *
 * Anyway...
 * Also note, you MIGHT need to change the files/folders permissions to make
 * this work. If the stylesheet and/or javascript files inside your module
 * doesn't load, try to set the directory and files to 0777, or the equivalent
 * on your system.
 *
 * END OF NOTICE
 * --------------------------------------------------------------------------
 *
 * Pluma - A Web CMS
 *
 * @package  Pluma
 * @author   John Lioneil P. Dionisio <john.dionisio1@gmail.com>
 *
 *
 *--------------------------------------------------------------------------
 * Register The Auto Loader
 *--------------------------------------------------------------------------
 *
 * Composer provides a convenient, automatically generated class loader for
 * our application. Code below will require it into the script here so that
 * we don't have to worry about manual loading any of our classes later on.
 *
 */

require __DIR__.'/bootstrap/autoload.php';

/**
 *---------------------------------------------------------------------------
 * Register the Error Reporting System & the Exception Handlers
 *---------------------------------------------------------------------------
 * These files are for development environment only as it may print out
 * sensitive information from the server.
 *
 */
require __DIR__.'/bootstrap/reporting.php';
require __DIR__.'/bootstrap/pretty-errors.php';

/**
 *---------------------------------------------------------------------------
 * App
 *---------------------------------------------------------------------------
 *
 * Get the app instance.
 *
 */
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
