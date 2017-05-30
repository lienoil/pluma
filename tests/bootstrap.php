<?php

require_once __DIR__.'/../vendor/autoload.php';

$whoop = new \Whoops\Run();
$whoops->pushHandler(new Whoops\Handler\PrettyPageHandler());
// ... add more

// Set Whoops as the default error and exception handler used by PHP:
$whoops->register();
throw new RuntimeException("Oopsie!");