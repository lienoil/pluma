@extends("Frontier::layouts.auth")

@section("content")
    <v-card class="grey lighten-5" flat>
        <v-toolbar dark class="primary elevation-0" extended></v-toolbar>
        <v-layout>
            <v-flex sm4 md5 offset-sm2>
                <router-view
                    name="login"
                    class="view"
                    transition="slide-x-transition"
                    :url="'{{ route('api.auth.login') }}'"
                    :meta="{{ json_encode([
                        'title' => __('Login'),
                        'subtitle' => ' | ' . __($application->site->title),
                        'social' => false
                    ]) }}"
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
                    :meta="{{ json_encode([
                        'title' => __('Register'),
                        'subtitle' => ' | ' . __($application->site->title),
                    ]) }}"
                    >
                    <v-flex slot>
                        <span class="grey--text">Have an account?</span>
                        <router-link to="/admin/login">Login</router-link>
                    </v-flex>
                </router-view>
            </v-flex>
        </v-layout>
    </v-card>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ present("user/{$application->token}/auth/login/dist/login.css") }}">
    <link rel="stylesheet" href="{{ present("user/{$application->token}/auth/register/dist/register.css") }}">
@endpush

@push('pre-js')
    <script src="{{ present("user/{$application->token}/auth/login/dist/login.js") }}"></script>
    <script src="{{ present("user/{$application->token}/auth/register/dist/register.js") }}"></script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name=csrf-token]').getAttribute('content');
        Vue.use(VeeValidate);

        Vue.component('login', login);
        Vue.component('register', register);

        let router = new VueRouter({
            mode: 'history',
            // base: '{{ url('/') }}',
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
@endpush
