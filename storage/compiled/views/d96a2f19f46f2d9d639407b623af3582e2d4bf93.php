<?php $__env->startSection("content"); ?>
    <register
        :meta="<?php echo e(json_encode([
            'title' => __($application->head->title),
            'subtitle' => __($application->site->title),
        ])); ?>">

        <v-flex>
            <span class="grey--text">Already have an account?</span>
            <a
                :href="'<?php echo e(route('login.show')); ?>'"
            >Login</a>
        </v-flex>
    </register>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(present("user/{$application->token}/auth/register/dist/register.css")); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pre-js'); ?>
    <script src="<?php echo e(present("user/{$application->token}/auth/register/dist/register.js")); ?>"></script>
    <script>
        Vue.component('register', register);
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.auth", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>