<?php

// Load Admin and Public routes

if (config('view.single-page-app', false)) {
    include_file(__DIR__,'/single.php');
}

include_file(__DIR__,'/admin.php');
include_file(__DIR__,'/public.php');
