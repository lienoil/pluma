<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $__env->yieldPushContent("pre-meta"); ?>
    <?php echo $__env->yieldPushContent("meta"); ?>
    <meta charset="UTF-8">
    <title><?php echo e(isset($application) && isset($application->title) ? $application->title : ''); ?></title>
    <?php echo $__env->yieldPushContent("post-meta"); ?>

    <?php echo $__env->yieldPushContent("pre-css"); ?>
    <?php echo $__env->yieldPushContent("css"); ?>
    <?php echo $__env->yieldPushContent("post-css"); ?>
</head>
<body>
