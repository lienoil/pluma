<?php echo $__env->make("Frontier::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<v-app id="approot">
    <?php echo $__env->yieldPushContent("root"); ?>
</v-app>

<?php echo $__env->make("Frontier::partials.scripts", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make("Frontier::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
