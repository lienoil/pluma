@extends("Frontier::layouts.auth")

@section("content")
    <main id="main" class="main">
        <v-container fluid fill-height>
            <v-layout row wrap justify-center align-center>
                <v-flex lg6 md10 sm10 xs12 justify-center align-center>

                    @include("Theme::partials.banner")

                    <v-card class="elevation-1 mb-1">
                        <v-layout row wrap>
                            <v-flex md5 xs12 class="accent">
                                <v-card flat class="transparent white--text" height="100%">
                                    <v-card-media height="100%" src="{{ settings('login_background', '') }}" class="text-xs-center">
                                        <v-layout row wrap fill-height justify-center align-end>
                                            <v-card-text class="text-xs-center">
                                                <p><img src="{{ $application->site->logo }}" width="30%"></p>
                                                <h4>{{ $application->site->title }}</h4>
                                                <p>{{ __($application->site->tagline) }}</p>
                                            </v-card-text>
                                        </v-layout>
                                    </v-card-media>
                                </v-card>
                            </v-flex>
                            <v-flex md7 xs12>
                                <form action="{{ route('login.login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <v-card tile flat transition="slide-x-transition" height="500px">
                                        <v-toolbar card class="white">
                                            {{-- <img class="brand-logo" width="30" class="mt-2" avatar src="{{ $application->site->logo }}" alt="{{ $application->site->title }}"/> --}}
                                            <v-toolbar-title class="brand-type grey--text text--darken-1">
                                                {{ $application->page->title }}
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
                                                    <v-btn info outline role="button" class="mx-0" href="{{ route('register.show') }}">{{ __('Create Account') }}</v-btn>
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
