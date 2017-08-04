<?php echo $__env->make("Frontier::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startSection("css", ""); ?>

<?php echo $__env->yieldContent("pre-content"); ?>
<?php echo $__env->yieldContent("content"); ?>
<?php echo $__env->yieldContent("post-content"); ?>

<?php echo $__env->make("Frontier::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
