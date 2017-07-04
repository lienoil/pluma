<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->yieldPushContent("pre-meta"); ?>
    <?php echo $__env->yieldPushContent("meta"); ?>
    <meta charset="UTF-8">
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->
    <title>
        <?php $__env->startSection("head.title"); ?><?php echo e(isset($application) && isset($application->head->title) ? $application->head->title : ''); ?><?php echo $__env->yieldSection(); ?>
        <?php $__env->startSection("head.subtitle"); ?><?php echo e(isset($application) && isset($application->head->subtitle) ? $application->head->subtitle : ''); ?><?php echo $__env->yieldSection(); ?>
    </title>
    <meta name="description" content="<?php echo e(@$application->head->description); ?>">
    <?php echo $__env->yieldPushContent("post-meta"); ?>

    <?php echo $__env->yieldPushContent("pre-css"); ?>
    

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vue"></script>
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vuetify/dist/vuetify.min.js"></script>
    <?php echo $__env->yieldPushContent("css"); ?>
    <?php echo $__env->yieldPushContent("post-css"); ?>
</head>
<body>
