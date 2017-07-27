<?php

// Get array of submodules, if any.
$submodules = submodules("Pluma", true);

include_files($submodules, "routes/routes.php");

// Load local admin and public routes, if any.
include_file(__DIR__, '/admin.php');
