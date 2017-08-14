<?php echo $__env->make("Theme::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div id="application-root" class="application-root" data-application-root>
    <v-app standalone>

        <?php echo $__env->yieldContent("pre-content"); ?>

        <main data-main>

            <?php $__env->startSection("pre-container"); ?>
                <?php echo $__env->make("Theme::partials.breadcrumbs", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldSection(); ?>

            <v-container fluid :style="`font-size: ${settings.fontsize.model}px`">

                <?php echo $__env->yieldContent("root"); ?>

            </v-container>

        </main>

        <?php $__env->startSection("post-container"); ?>
            <?php echo $__env->make("Theme::partials.endnote", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldSection(); ?>

        <?php echo $__env->yieldContent("post-content"); ?>

    </v-app>
</div>

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
