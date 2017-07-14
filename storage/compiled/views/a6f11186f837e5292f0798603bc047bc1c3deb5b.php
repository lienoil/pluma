<?php $__env->startPush('root'); ?>
    <v-card class="grey lighten-5" flat>
        <v-toolbar dark class="primary elevation-0" extended></v-toolbar>
        <v-layout>
            <v-flex sm4 offset-sm2>
                <router-view
                    name="login"
                    class="view"
                    transition="slide-x-transition"
                    :url="'<?php echo e(route('api.auth.login')); ?>'"
                    :meta="<?php echo e(json_encode([
                        'title' => __('Login'),
                        'subtitle' => ' | ' . __($application->site->title),
                        'social' => false
                    ])); ?>"
                    >
                    <v-flex slot>
                        <router-link class="mr-3" to="/admin/register">Create Account</router-link>
                        <router-link class="mr-3" to="/recovery/password">Lost password?</router-link>
                    </v-flex>
                </router-view>

                <router-view
                    name="register"
                    class="view"
                    transition="slide-x-transition"
                    :meta="<?php echo e(json_encode([
                        'title' => __('Register'),
                        'subtitle' => ' | ' . __($application->site->title),
                    ])); ?>"
                    >
                    <v-flex slot>
                        <span class="grey--text">Have an account?</span>
                        <router-link to="/admin/login">Login</router-link>
                    </v-flex>
                </router-view>
            </v-flex>
        </v-layout>
    </v-card>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(present("user/{$application->token}/auth/login/dist/login.css")); ?>">
    <link rel="stylesheet" href="<?php echo e(present("user/{$application->token}/auth/register/dist/register.css")); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('pre-js'); ?>
    <script src="<?php echo e(present("user/{$application->token}/auth/login/dist/login.js")); ?>"></script>
    <script src="<?php echo e(present("user/{$application->token}/auth/register/dist/register.js")); ?>"></script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content');
        Vue.use(VeeValidate);

        Vue.component('login', login);
        Vue.component('register', register);

        let router = new VueRouter({
            mode: 'history',
            // base: '<?php echo e(url('/')); ?>',
            routes: [
                {path: '/admin', component: login},
                {
                    path: '/admin/login',
                    components: {login},
                    props: function () {
                        return {
                            meta: {
                                title: 'Login',
                                subtitle: 'Sublog'
                            }
                        };
                    },
                },
                {
                    path: '/admin/register',
                    components: {register},
                },
            ],
        });

        const _pp = new Vue({
            router: router,
        }).$mount('v-app');
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make("Frontier::layouts.master", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>