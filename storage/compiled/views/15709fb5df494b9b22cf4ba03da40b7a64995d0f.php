<?php $__env->startSection("content"); ?>
    <v-card flat class="transparent ma-0">
        <div class="primary" style="height: 3px;"></div>
        <v-toolbar class="accent elevation-0" extended></v-toolbar>
        <v-layout>
            <v-flex xs10 sm6 md4 offset-sm3 offset-md4 offset-xs1>

                <?php echo $__env->make("Theme::partials.banner", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                <v-card class="card--flex-toolbar card--flex-toolbar--stylized" transition="slide-x-transition">
                    <v-toolbar card class="white text-xs-center" prominent>
                        <v-spacer v-if="settings && settings.logo_is_centered"></v-spacer>
                        <img class="brand-logo" width="40" avatar src="<?php echo e($application->site->logo); ?>" alt="<?php echo e($application->site->title); ?>">
                        <v-toolbar-title class="brand-type accent--text"><?php echo e(__($application->site->title)); ?></v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-container fluid>
                        <form method="POST" action="<?php echo e(route('login.login')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <v-text-field
                                :error-messages="resource.errors.username"
                                class="input-group"
                                label="Email or username"
                                name="username"
                                type="text"
                                hide-details
                                value="<?php echo e(old('username')); ?>"
                            ></v-text-field>
                            <v-text-field
                                :append-icon-cb="() => (resource.visible = !resource.visible)"
                                :append-icon="resource.visible ? 'visibility' : 'visibility_off'"
                                :error-messages="resource.errors.password"
                                :type="resource.visible ? 'text': 'password'"
                                class="input-group"
                                label="Password"
                                min="6"
                                name="password"
                                hide-details
                                value="<?php echo e(old('password')); ?>"
                            ></v-text-field>

                            <v-checkbox
                                :checked="resource.remember"
                                label="Remember Me"
                                light
                                hide-details
                                v-model="resource.remember"
                                @click="() => {resource.remember = !resource.remember}"
                            ></v-checkbox>
                            <input v-if="resource.remember" type="hidden" name="remember" value="true">

                            
                            
                            

                            <v-card-actions>
                                <v-btn class="ma-0" primary type="submit"><?php echo e(__("Login")); ?></v-btn>
                                <v-spacer></v-spacer>
                                <v-btn class="ma-0" role="button" secondary outline href="<?php echo e(route('register.show')); ?>"><?php echo e(__('Create Account')); ?></v-btn>
                            </v-card-actions>
                        </form>
                    </v-container>

                    <v-divider></v-divider>

                    <v-card-actions class="pa-3">
                        <v-spacer></v-spacer>
                        <a href="<?php echo e(route('register.show')); ?>"><?php echo e(__('Lost password?')); ?></a>
                    </v-card-actions>
                </v-card>

                <?php echo $__env->yieldPushContent('post-login'); ?>

                <div class="text-xs-center mt-1 mb-4">
                    <small class="grey--text"><?php echo e(__($application->site->copyright)); ?></small>
                </div>

            </v-flex>
        </v-layout>
    </v-card>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('post-css'); ?>
    <style>
        .card--flex-toolbar--stylized {
            margin-top: -65px;
        }
    </style>
    
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pre-scripts'); ?>
    <script>
        mixins.push({
            data () {
                return {
                    settings: {},
                    resource: {
                        errors: JSON.parse('<?php echo json_encode($errors->getMessages()); ?>'),
                        item: [],
                        model: false,
                        remember: true,
                        visible: false,
                    }
                };
            },
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Theme::layouts.auth", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>