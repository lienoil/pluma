<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->yieldPushContent("pre-meta"); ?>
    <?php echo $__env->yieldPushContent("meta"); ?>
    <meta charset="UTF-8">
    <title>
        <?php $__env->startSection("head.title"); ?><?php echo e(isset($application) && isset($application->head->title) ? $application->head->title : ''); ?><?php echo $__env->yieldSection(); ?>
        <?php $__env->startSection("head.subtitle"); ?><?php echo e(isset($application) && isset($application->page->subtitle) ? $application->page->subtitle : ''); ?><?php echo $__env->yieldSection(); ?>
    </title>
    <meta name="description" content="<?php echo e(@$application->head->description); ?>">
    <?php echo $__env->yieldPushContent("post-meta"); ?>

    <?php echo $__env->yieldPushContent("pre-css"); ?>
    <?php echo $__env->yieldPushContent("css"); ?>
    <?php echo $__env->yieldPushContent("post-css"); ?>
</head>
<body>

    <?php echo $__env->yieldContent("content"); ?>

    <?php echo $__env->yieldPushContent("pre-footer"); ?>
    <?php echo $__env->yieldPushContent("footer"); ?>
    <?php echo $__env->yieldPushContent("post-footer"); ?>

    <?php echo $__env->yieldPushContent("pre-js"); ?>
    <?php echo $__env->yieldPushContent("js"); ?>
    <?php echo $__env->yieldPushContent("post-js"); ?>
</body>
</html>