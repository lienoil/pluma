<?php $__env->startSection("pre-container", ""); ?>
<?php $__env->startSection("post-container", ""); ?>

<?php $__env->startSection("root"); ?>
    <?php echo $__env->yieldContent("Template::public.menu"); ?>
    <?php echo $__env->yieldContent("content"); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Theme::layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>