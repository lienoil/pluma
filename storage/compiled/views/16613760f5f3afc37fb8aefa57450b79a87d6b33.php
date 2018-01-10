<?php $__env->startSection("head-title", __("404 Error - Page Not Found")); ?>

<?php $__env->startSection("content"); ?>

    <v-layout row wrap>
        <v-flex xs8 offset-xs2>

            <h1 class="display-6 mt-4 mb-0 accent--text"><strong><?php echo e(__('404 Error')); ?></strong></h1>
            <p class="display-3 mt-0 grey--text"><?php echo e(__('Page Not Found')); ?></p>

        </v-flex>
    </v-layout>

<?php $__env->stopSection(); ?>

<?php echo $__env->make("Frontier::layouts.public", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>