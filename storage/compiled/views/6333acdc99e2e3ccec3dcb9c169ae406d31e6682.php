<?php $__env->startSection("theme-css"); ?>
    
    <link href="<?php echo e(theme('css/style.css')); ?>?v=<?php echo e($application->version); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Frontier::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>