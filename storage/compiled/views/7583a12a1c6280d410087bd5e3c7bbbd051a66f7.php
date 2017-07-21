<?php $__env->startSection("content"); ?>
    <div class="container">
        <div class="">
            <h3 class="page--title"><?php echo e($application->page->title); ?></h3>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>