<?php echo $__env->make("Frontier::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div id="application-root" class="application-root" data-application-root>
    <v-app standalone>

        <?php echo $__env->yieldContent("pre-content"); ?>

        <main data-main>

            <?php $__env->startSection("pre-container"); ?>
                <?php echo $__env->make("Frontier::partials.breadcrumbs", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldSection(); ?>

            <v-container fluid :style="`font-size: ${settings.fontsize.model}px`">

                <?php echo $__env->yieldContent("root"); ?>

            </v-container>

        </main>

        <?php $__env->startSection("post-container"); ?>
            <?php echo $__env->make("Frontier::partials.endnote", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldSection(); ?>

        <?php echo $__env->yieldContent("post-content"); ?>

    </v-app>
</div>

<?php $__env->startSection("scripts"); ?>
    <script>
        let mixins = [{
            data: {
                page: {
                    model: false,
                },
            },
        }];
    </script>
    <?php echo $__env->yieldPushContent("pre-scripts"); ?>
    <script src='<?php echo e(present("frontier/app/dist/app.js")); ?>'></script>
    <script>
        // const app = new Vue({
        //     el: '#application-root',
        //     mixins : mixins,
        //     data: {
        //         dark: true, light: false,
        //         mini: false, drawer: true,
        //         menu: {
        //             open: false,
        //         },
        //         theme: {
        //             avatar: 'red',
        //             utilitybar: 'white',
        //         },
        //     },
        // });
    </script>
    <?php echo $__env->yieldPushContent("post-scripts"); ?>
<?php echo $__env->yieldSection(); ?>

<?php echo $__env->make("Frontier::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
