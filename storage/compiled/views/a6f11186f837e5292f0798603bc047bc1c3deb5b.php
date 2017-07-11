<?php $__env->startPush("root"); ?>
    <?php echo $__env->yieldContent("content"); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>