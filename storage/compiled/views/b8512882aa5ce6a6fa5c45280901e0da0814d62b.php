<?php $__env->startSection("head.title", "404 Error"); ?>

<?php $__env->startSection("content"); ?>
    <p>404 <?php echo e($error['code']); ?></p>
    <p><?php echo e($error['message']); ?></p>
    <p><?php echo e($error['description']); ?></p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("Frontier::layouts.public", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>