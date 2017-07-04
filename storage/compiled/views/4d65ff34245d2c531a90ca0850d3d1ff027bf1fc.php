<?php echo $__env->make("Single::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div data-root-app>
        <?php echo $__env->make("Single::partials.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make("Single::partials.toolbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <main>
            <v-container fluid></v-container>
        </main>
        <?php echo $__env->make("Single::partials.endnote", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>

    <script>
        var app = new Vue({
            el: '[data-root-app]',
            data: {
                message: 'Hello Vue!',
                application: JSON.parse('<?php echo json_encode($application); ?>'),
                sidebar: JSON.parse('<?php echo json_encode($navigation->sidebar->collect); ?>'),
                drawer: true,
                mini: false,
                dark: true,
            }
        });
    </script>

<?php echo $__env->make("Single::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
