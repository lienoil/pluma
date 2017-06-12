<?php

// Get array of submodules, if any.
$submodules = submodules("Pluma", true);

include_files($submodules, "routes/routes.php");

// Load Admin and Public routes
include_file(__DIR__,'/admin.php');
include_file(__DIR__,'/public.php');
