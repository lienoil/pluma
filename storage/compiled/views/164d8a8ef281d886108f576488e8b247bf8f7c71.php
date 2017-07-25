<?php $__env->startSection("content"); ?>
    <form action="<?php echo e(route('pages.store')); ?>" method="POST">
        <v-layout row wrap>
            <v-flex md8>
                <v-card>
                    <v-text-field></v-text-field>
                </v-card>
            </v-flex>
        </v-layout>
    </form>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>