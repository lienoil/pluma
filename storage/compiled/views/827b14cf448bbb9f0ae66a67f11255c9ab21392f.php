<?php $__env->startSection("content"); ?>
    <template>
        <v-card class="grey lighten-5" flat>
            <v-toolbar dark class="primary elevation-0" extended></v-toolbar>
            <v-layout row>
                <v-flex xs4 offset-xs4>
                    <v-card class="card--flex-toolbar card--flex-toolbar--stylized">
                        <v-toolbar card class="white" prominent>
                            <v-toolbar-title><?php echo e(__('Login')); ?> | <?php echo e($application->site->title); ?></v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-divider></v-divider>
                        <v-card-text>
                            <v-layout row>
                                <v-flex>
                                    <v-text-field
                                        name="username"
                                        label="Email or username"
                                        class="input-group"
                                    ></v-text-field>
                                    <v-text-field
                                        name="password"
                                        label="Password"
                                        hint="At least 6 characters"
                                        min="6"
                                        :append-icon="visible ? 'visibility' : 'visibility_off'"
                                        :append-icon-cb="() => (visible = !visible)"
                                        :type="visible ? 'text': 'password'"
                                        class="input-group"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-card>
    </template>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
    <style>
        .card--flex-toolbar--stylized {
            margin-top: -64px;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('js'); ?>
    <script>
        export default {
            data () {
                return {
                    visible: false
                }
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.auth", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>