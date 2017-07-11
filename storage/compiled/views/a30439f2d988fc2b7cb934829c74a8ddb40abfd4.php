<?php echo $__env->make("Frontier::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<v-app id="approot">
    <?php echo $__env->yieldPushContent("root"); ?>
</v-app>

<script>
    let app = new Vue({
        el: 'v-app',
        data: {
            message: 'Lorem ipsum.'
        }
    });
</script>

<?php echo $__env->make("Frontier::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
