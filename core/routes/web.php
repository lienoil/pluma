<?php

// Get array of submodules, if any.
$submodules = submodules("Pluma", true);

// include_files($submodules, "routes/routes.php");

Route::get('/', function ()
{
    dd('asd');
});

// Load local admin and public routes, if any.
include_file(__DIR__,'/admin.php');
include_file(__DIR__,'/public.php');
