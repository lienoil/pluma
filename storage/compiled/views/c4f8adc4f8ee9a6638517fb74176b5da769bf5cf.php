<?php echo $__env->make("Theme::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent("pre-content"); ?>

<div id="application-root" class="application-root" data-application-root>
    <v-app standalone>
        <?php echo $__env->yieldContent("content"); ?>
    </v-app>
</div>

<?php echo $__env->yieldContent("post-content"); ?>

<?php $__env->startSection("scripts"); ?>
    <script>
        let mixins = [{ data: { page: { model: false, }, }, }];
    </script>
    <?php echo $__env->yieldPushContent("pre-scripts"); ?>
    <script src='<?php echo e(assets("frontier/app/filters.js")); ?>'></script>
    <script src='<?php echo e(assets("frontier/app/dist/app.js")); ?>'></script>
    <?php echo $__env->yieldPushContent("post-scripts"); ?>
<?php echo $__env->yieldSection(); ?>

<?php echo $__env->make("Theme::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
