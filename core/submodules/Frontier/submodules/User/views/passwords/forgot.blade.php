@extends("Theme::layouts.auth")

@section("content")
    <main id="main" class="main">
        <v-container fluid fill-height>
            <v-layout fill-height column wrap justify-center align-center>
                <v-flex lg6 md10 sm10 xs12 fill-height justify-center align-center>

                    @include("Theme::partials.banner")

                    <v-card class="elevation-1 mb-3">
                        <v-layout row wrap>
                            <v-flex md4 xs12 class="teal accent-4">
                                <v-layout row wrap justify-center align-center>
                                    <v-flex xs12>
                                        <v-card class="elevation-0 transparent white--text" height="100%">
                                            <v-card-text class="text-xs-center">
                                                <v-layout row wrap justify-center align-center>
                                                    <v-flex xs12>
                                                        <p><img src="{{ settings('login_logo', assets('frontier/images/placeholder/paper-pencil-magnifier.svg')) }}" alt="" width="150"></p>
                                                        <h4>{{ __("Password Recovery") }}</h4>
                                                        <p>{{ __("We need you to verify your email address so you can proceed in resetting your password.") }}</p>
                                                    </v-flex>
                                                </v-layout>
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex md8 xs12>
                                <form action="{{ route('password.send') }}" method="POST">
                                    {{ csrf_field() }}
                                    <v-card tile flat transition="slide-x-transition" height="500px">
                                        <v-toolbar card class="white">
                                            <img class="brand-logo" width="30" class="mt-2" avatar src="{{ $application->site->logo }}" alt="{{ $application->site->title }}"/>
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
                                                        :error-messages="resource.errors.email"
                                                        name="email"
                                                        type="email"
                                                        label="{{ __('Email') }}"
                                                        :value="resource.item.email"
                                                    ></v-text-field>
                                                </v-card-text>
                                                <v-card-actions class="px-0">
                                                    <v-btn role="button" class="teal white--text elevation-1 mx-0" type="submit">{{ __("Send to email") }}</v-btn>
                                                    <v-spacer></v-spacer>
                                                </v-card-actions>
                                                <v-card-actions>
                                                    <a class="grey--text" href="{{ route('login.show') }}">{{ __('Login') }}</a>
                                                    <span>{{ __('or') }}</span>
                                                    <a class="grey--text" href="{{ route('register.show') }}">{{ __('Signup') }}</a>
                                                    <v-spacer></v-spacer>
                                                </v-card-actions>
                                            </v-card>

                                        </v-card-text>
                                    </v-card>
                                </form>

                                @stack('post-login')
                            </v-flex>
                        </v-layout>
                    </v-card>

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
                    resource: {
                        item: {
                            email: '{{ old('email') }}',
                        },
                        errors: {!! json_encode($errors->getMessages()) !!},
                    }
                }
            }
        })
    </script>
@endpush
