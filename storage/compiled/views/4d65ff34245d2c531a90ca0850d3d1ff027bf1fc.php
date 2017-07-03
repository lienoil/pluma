<?php echo $__env->make("Single::partials.header", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div id="root-app">
    
    <v-toolbar></v-toolbar>
    <main>
        <v-container fluid>
            {{ message }}
            <router-view></router-view>
        </v-container>
    </main>
    <v-footer></v-footer>
</div>

<?php echo $__env->make("Single::partials.footer", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        var app = new Vue({
            el: '#root-app',
            data: {
                message: 'Hello Vue!'
            }
        });
    </script>
<?php $__env->stopPush(); ?>
