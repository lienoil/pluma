<?php $__env->startSection("content"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <header class="header">
                    <h1 class="page-title"><?php echo e(__($page->title)); ?></h1>
                </header>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <main id="main" class="main">
                    <?php echo __($page->body); ?>

                </main>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Frontier::layouts.public", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>