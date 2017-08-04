<?php $__env->startPush("utilitybar"); ?>
    
<?php $__env->stopPush(); ?>

<?php $__env->startPush("page-settings"); ?>
    <v-card>
        <v-card-text>
            <h5 class="headline">
                <v-icon><?php echo e($application->page->icon); ?></v-icon>
                <?php echo e(__($application->page->title)); ?>

            </h5>
            <p class="grey--text"><?php echo e(__("Edit Grant here.")); ?></p>
        </v-card-text>
    </v-layout>
<?php $__env->stopPush(); ?>

<?php $__env->startSection("content"); ?>
    <v-layout row wrap>
        <v-flex sm8>
            <form id="editGrantForm" class="form form--edit">
                <v-card class="lighten-4 grey--text elevation-1 mb-2">
                    <v-toolbar class="primary lighten-2 elevation-0">
                        <v-toolbar-title class="white--text"><?php echo e(__('Edit Grant')); ?></v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                            name="name"
                            label="Name"
                            value="<?php echo e($resource->name); ?>"
                        ></v-text-field>
                        <v-text-field
                            name="code"
                            label="Code"
                            value="<?php echo e($resource->code); ?>"
                        ></v-text-field>
                        <v-text-field
                            name="description"
                            label="Description"
                            value="<?php echo e($resource->description); ?>"
                        ></v-text-field>
                    </v-card-text>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-card class="elevation-0">
                                <v-card-text class="grey--text text--darken-2 grey lighten-5">
                                    <?php echo e(__('Permissions')); ?>

                                    <v-spacer></v-spacer>
                                </v-card-text>
                                <v-card-text>
                                    <v-layout row wrap>
                                        <v-flex xs6>
                                            <v-card-title><p class="text-xs-center mb-0">Available</p></v-card-title>

                                            <draggable
                                                :element="'table'"
                                                v-model="availables"
                                                
                                                @start="drag=true"
                                                @end="drag=false"
                                            >
                                                <tr v-for="av in availables"></tr>
                                            </draggable>

                                            
                                        </v-flex>
                                        <v-flex xs6>
                                            <v-card-title><p class="text-xs-center mb-0">Selected</p></v-card-title>
                                        </v-flex>
                                    </v-layout>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-card-text>
                        <v-btn primary>Submit</v-btn>
                    </v-card-text>
                </v-card>
            </form>
        </v-flex>
    </v-layout>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('pre-scripts'); ?>
    <script src="<?php echo e(assets('frontier/vendor/vue/draggable/draggable.min.js')); ?>"></script>
    <script>
        Vue.component('draggable', draggable);

        mixins.push({
            data () {
                return {
                    availables: <?php echo json_encode($permissions); ?>,
                };
            },
            components: {
                draggable: draggable,
            }
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.admin", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>