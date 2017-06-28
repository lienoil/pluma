<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->yieldPushContent("pre-meta"); ?>
    <?php echo $__env->yieldPushContent("meta"); ?>
    <meta charset="UTF-8">
    <title>
        <?php $__env->startSection("head.title"); ?><?php echo e(isset($application) && isset($application->head->title) ? $application->head->title : ''); ?><?php echo $__env->yieldSection(); ?>
        <?php $__env->startSection("head.subtitle"); ?><?php echo e(isset($application) && isset($application->head->subtitle) ? $application->head->subtitle : ''); ?><?php echo $__env->yieldSection(); ?>
    </title>
    <meta name="description" content="<?php echo e(@$application->head->description); ?>">
    <?php echo $__env->yieldPushContent("post-meta"); ?>

    <?php echo $__env->yieldPushContent("pre-css"); ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <?php echo $__env->yieldPushContent("css"); ?>
    <?php echo $__env->yieldPushContent("post-css"); ?>
</head>
<body>
