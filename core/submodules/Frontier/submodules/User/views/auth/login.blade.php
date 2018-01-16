@extends("Theme::layouts.auth")

@section("content")
    <main id="main" class="main">
        <v-container fluid fill-height>
            <v-layout fill-height column wrap justify-center align-center>
                <v-flex lg6 md10 sm10 xs12 fill-height justify-center align-center>

                    @include("Theme::partials.banner")

                    <v-card class="elevation-1 mb-1">
                        <v-layout row wrap>
                            <v-flex md5 xs12 class="accent lighten-1">
                                <v-layout row wrap justify-center align-center>
                                    <v-flex xs12>
                                        <v-card class="elevation-0 transparent white--text" height="100%">
                                            <v-card-text class="text-xs-center">
                                                <v-layout row wrap justify-center align-center>
                                                    <v-flex xs12>
                                                        <p><img src="{{ settings('login_logo', assets('frontier/images/placeholder/paper-pencil-magnifier.svg')) }}" alt="" width="150"></p>
                                                        <h4>{{ $application->site->title }}</h4>
                                                        <p>{{ __($application->site->tagline) }}</p>
                                                    </v-flex>
                                                </v-layout>
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex md7 xs12>
                                <form action="{{ route('login.login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <v-card tile flat transition="slide-x-transition" height="500px">
                                        <v-toolbar card class="white">
                                            <img class="brand-logo" width="30" class="mt-2" avatar src="{{ $application->site->logo }}" alt="{{ $application->site->title }}"/>
                                            <v-toolbar-title class="brand-type grey--text text--darken-1">
                                                {{ $application->site->title }} <span class="grey--text">| {{ $application->page->title }}</span>
                                            </v-toolbar-title>
                                            <v-spacer></v-spacer>
                                        </v-toolbar>
                                        <v-divider></v-divider>
                                        <v-card-text>
                                            <v-card flat>
                                                <v-card-text class="pa-0">
                                                    <v-text-field
                                                        :error-messages="resource.errors.username"
                                                        class="input-group"
                                                        label="{{ __('Email or username') }}"
                                                        name="username"
                                                        value="{{ old('username') }}"
                                                    ></v-text-field>
                                                    <v-text-field
                                                        :append-icon-cb="() => (resource.visible = !resource.visible)"
                                                        :append-icon="resource.visible ? 'visibility' : 'visibility_off'"
                                                        :error-messages="resource.errors.password"
                                                        :type="resource.visible ? 'text': 'password'"
                                                        class="input-group"
                                                        label="{{ __('Password') }}"
                                                        min="6"
                                                        name="password"
                                                        value="{{ old('password') }}"
                                                    ></v-text-field>

                                                    <v-checkbox
                                                        :checked="resource.remember"
                                                        label="Remember Me"
                                                        light
                                                        class="mb-3"
                                                        color="primary"
                                                        hide-details
                                                        v-model="resource.remember"
                                                        @click="() => {resource.remember = !resource.remember}"
                                                    ></v-checkbox>
                                                    <input v-if="resource.remember" type="hidden" name="remember" value="true">
                                                </v-card-text>
                                                <v-card-actions>
                                                    <v-btn primary role="button" class="elevation-1 mx-0" type="submit">{{ __("Login") }}</v-btn>
                                                    <v-spacer></v-spacer>
                                                    <v-btn info outline role="button" href="{{ route('register.show') }}">{{ __('Create Account') }}</v-btn>
                                                </v-card-actions>
                                                <v-card-actions>
                                                    <a class="grey--text" href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                                                </v-card-actions>
                                            </v-card>

                                        </v-card-text>
                                    </v-card>
                                </form>

                                @stack('post-login')
                            </v-flex>
                        </v-layout>
                    </v-card>
                    <v-card-actions class="px-0">
                        <v-spacer></v-spacer>
                        <small class="grey--text text--darken-1">{{ __($application->site->copyright) }}</small>
                    </v-card-actions>
                </v-flex>
            </v-layout>
        </v-container>
    </main>
@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    settings: {},
                    resource: {
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        item: [],
                        model: false,
                        remember: true,
                        visible: false,
                    },
                };
            },
        });
    </script>
@endpush
