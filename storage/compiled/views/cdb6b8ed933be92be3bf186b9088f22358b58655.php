<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->yieldPushContent("pre-meta"); ?>
    <?php echo $__env->yieldPushContent("meta"); ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(url('favicons/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(url('favicons/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(url('favicons/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(url('favicons/manifest.json')); ?>">
    <link rel="mask-icon" color="#f1b53c" href="<?php echo e(url('favicons/safari-pinned-tab.svg')); ?>">
    <meta name="theme-color" content="#ffffff">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->
    <title>
        <?php $__env->startSection("head-title"); ?><?php echo e(isset($application) && isset($application->head->title) ? __($application->head->title ): ''); ?><?php echo $__env->yieldSection(); ?>
        <?php $__env->startSection("head-subtitle"); ?><?php echo e(isset($application) && isset($application->head->subtitle) ? __($application->head->subtitle) : ''); ?><?php echo $__env->yieldSection(); ?>
    </title>
    <meta name="description" content="<?php echo e(__(@$application->head->description)); ?>">
    <?php echo $__env->yieldPushContent("post-meta"); ?>

    <?php echo $__env->yieldPushContent("pre-css"); ?>

    <?php echo $__env->yieldPushContent('fonts'); ?>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <?php echo font_link_tags(); ?>

    <?php echo $__env->yieldSection(); ?>

    <?php echo $__env->yieldPushContent("css"); ?>
        <link href="<?php echo e(assets('frontier/vendors/vuetify/dist/vuetify.min.css')); ?>?v=<?php echo e($application->version); ?>" rel="stylesheet">
        
        <?php if(env('APP_ENV', 'production') == 'development'): ?>
            <script src="<?php echo e(assets('frontier/vendors/vue/dist/vue.js')); ?>?v=<?php echo e($application->version); ?>"></script>
        <?php else: ?>
            <script src="<?php echo e(assets('frontier/vendors/vue/dist/vue.min.js')); ?>?v=<?php echo e($application->version); ?>"></script>
        <?php endif; ?>
        <script src="<?php echo e(assets('frontier/vendors/vuetify/dist/vuetify.min.js')); ?>?v=<?php echo e($application->version); ?>"></script>
        
    <?php echo $__env->yieldSection(); ?>

    <?php echo $__env->yieldPushContent("post-css"); ?>

    
    <?php $__env->startSection("theme-css"); ?>
    <link href="<?php echo e(theme('css/style.css')); ?>?v=<?php echo e($application->version); ?>" rel="stylesheet">
    <?php echo $__env->yieldSection(); ?>
    
</head>
<body>
    <?php echo $__env->make("Theme::warnings.general", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make("Theme::partials.backdrop", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
