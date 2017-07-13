<?php $__env->startSection("content"); ?>
    <login :title="'<?php echo e(__($application->head->title)); ?>'">
        <v-flex>
            <a
                :href="'<?php echo e(route("register.show")); ?>'"
            >Register</a>
        </v-flex>
    </login>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(present("user/{$application->token}/login/dist/login.css")); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pre-js'); ?>
    <script src="<?php echo e(present("user/{$application->token}/login/dist/login.js")); ?>"></script>
    <script>
        Vue.component('login', login);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.auth", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>