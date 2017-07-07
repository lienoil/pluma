<?php echo $__env->make("Single::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<v-app>
    <?php echo $__env->make("Single::components.navigation-drawer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make("Single::components.toolbar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <main>
        <v-container fluid>
            <?php echo $__env->yieldContent("content"); ?>
            
        </v-container>
    </main>
    <?php echo $__env->make("Single::components.endnote", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</v-app>

<script>
    var app = new Vue({
        el: 'v-app',
        data: {
            application: JSON.parse('<?php echo json_encode($application); ?>'),
            user: JSON.parse('<?php echo json_encode(auth()->user()); ?>'),
            sidebar: JSON.parse('<?php echo json_encode($navigation->sidebar->collect); ?>'),
            drawer: true,
            mini: false,
            theme: 'dark',
            dark: true,
            light: false,
        }
    });
</script>

<?php echo $__env->make("Single::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
