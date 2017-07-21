<?php $__env->startSection("content"); ?>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card class="elevation-0 mb-4" min-height="200px">
                <v-card-title class="headline"><?php echo e(__('Welcome')); ?></v-card-title>
                <v-card-text>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem, eos molestias voluptatum, perferendis reiciendis obcaecati minima ad earum accusantium incidunt suscipit dolore nihil repudiandae tempora doloribus, inventore velit voluptates corporis?</p>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
    <v-layout row wrap>
        <v-flex md8>
            <v-card class="white elevation-1 mb-4">
                <v-card-text></v-card-text>
            </v-card>
        </v-flex>
        <v-flex md4>
            <?php echo $__env->make("Frontier::widgets.calendar", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </v-flex>
    </v-layout>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>