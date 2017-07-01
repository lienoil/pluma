<?php echo $__env->make("Frontier::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">

    <?php echo $__env->yieldContent("pre-content"); ?>

    <?php echo $__env->make("Frontier::partials.utilitybar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make("Frontier::partials.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <main id="main" class="mdl-layout__content">
        <div class="page-content">
            <?php echo $__env->yieldContent("content"); ?>
        </div>
    </main>

    <?php echo $__env->yieldContent("post-content"); ?>

</div>

<?php echo $__env->make("Frontier::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>