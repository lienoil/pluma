<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->yieldPushContent("pre-meta"); ?>
    <?php echo $__env->yieldPushContent("meta"); ?>
    <meta charset="UTF-8">
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

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
        <?php $__env->startSection("head.title"); ?><?php echo e(isset($application) && isset($application->head->title) ? __($application->head->title ): ''); ?><?php echo $__env->yieldSection(); ?>
        <?php $__env->startSection("head.subtitle"); ?><?php echo e(isset($application) && isset($application->head->subtitle) ? __($application->head->subtitle) : ''); ?><?php echo $__env->yieldSection(); ?>
    </title>
    <meta name="description" content="<?php echo e(__(@$application->head->description)); ?>">
    <?php echo $__env->yieldPushContent("post-meta"); ?>

    <?php echo $__env->yieldPushContent("pre-css"); ?>
    <script>window.csrfToken = "<?php echo e(csrf_token()); ?>";</script>
    
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
    
    <script src="https://unpkg.com/vue@2.3.4"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-router/2.0.1/vue-router.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vee-validate/2.0.0-rc.7/vee-validate.min.js"></script>
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/vuetify/dist/vuetify.min.js"></script>
    
    <?php echo $__env->yieldPushContent("css"); ?>
    <?php echo $__env->yieldPushContent("post-css"); ?>
</head>
<body>
