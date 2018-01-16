@extends("Theme::layouts.auth")

@section("content")
    <main id="main" class="main">
        <v-container fluid fill-height>
            <v-layout fill-height column wrap justify-center align-center>
                <v-flex lg6 md10 sm10 xs12 fill-height justify-center align-center>

                    @include("Theme::partials.banner")

                    <v-card class="elevation-1 white mb-3">
                        <v-layout row wrap>
                            <v-flex xs12>
                                <v-layout row wrap justify-center align-center>
                                    <v-flex xs12>
                                        <v-card flat class="ma-2 pa-4 teal accent-4 white--text" height="100%">
                                            <v-card-text class="pa-3 text-xs-center">
                                                <v-layout row wrap justify-center align-center>
                                                    <v-flex xs12>
                                                        <p><img src="{{ settings('login_logo', assets('frontier/images/placeholder/email.svg')) }}" width="230"></p>
                                                        <h4>{{ __("Check your Email") }}</h4>
                                                        <p class="headline">{{ __("We've sent a password reset link to your email. Please check it for further instructions.") }}</p>
                                                        <br>
                                                        <p class="caption">{{ __("(You can close this window now)") }}</p>
                                                    </v-flex>
                                                </v-layout>
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-layout>
                    </v-card>

                    <div class="text-xs-center grey--text caption">{{ $application->site->copyright }}</div>

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
