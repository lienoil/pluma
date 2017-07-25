<?php $__env->startSection("pre-content"); ?>
    <?php echo $__env->make("Frontier::partials.sidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make("Frontier::partials.utilitybar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("root"); ?>
    <?php echo $__env->yieldContent("content"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("post-content"); ?>
    <?php echo $__env->make("Frontier::partials.rightsidebar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make("Frontier::partials.dialog", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("endnote"); ?>
    <v-container fluid class="pa-0">
        <v-layout row wrap>
            <v-flex xs6>
                <small class="blue--text"><?php echo e($application->site->copyright); ?></small>
            </v-flex>
            <v-flex xs6 class="text-xs-right">
                <small class="blue--text"><?php echo e($application->version); ?></small>
            </v-flex>
        </v-layout>
    </v-container>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Frontier::layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>