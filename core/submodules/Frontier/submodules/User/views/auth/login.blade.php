@extends("Theme::layouts.auth")

@section("content")
    <v-card flat class="transparent ma-0">
        {{-- <div class="primary" style="height: 3px;"></div> --}}
        <v-toolbar class="accent elevation-0" extended></v-toolbar>
        <v-layout>
            <v-flex xs10 sm6 md4 offset-sm3 offset-md4 offset-xs1>

                @include("Theme::partials.banner")

                <v-card class="card--flex-toolbar card--flex-toolbar--stylized" transition="slide-x-transition">
                    <v-toolbar card class="white text-xs-center" prominent>
                        <v-spacer v-if="settings && settings.logo_is_centered"></v-spacer>
                        <img class="brand-logo" width="40" avatar src="{{ $application->site->logo }}" alt="{{ $application->site->title }}">
                        <v-toolbar-title class="brand-type accent--text">{{ __($application->site->title) }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-container fluid>
                        <form action="{{ route('login.login') }}" method="POST">
                            {{ csrf_field() }}
                            <v-text-field
                                :error-messages="resource.errors.username"
                                class="input-group"
                                label="Email or username"
                                name="username"
                                type="text"
                                hide-details
                                value="{{ old('username') }}"
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
                                value="{{ old('password') }}"
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

                            {{-- Template --}}
                            {{-- <template inline-template>
                                <div class="hr">
                                    <strong class="hr-text grey--text text--lighten-2">or</strong>
                                </div>
                                <v-layout>
                                    <v-flex md6 class="text-xs-center">
                                        <v-btn block class="grey--text elevation-0">
                                            <i class="fa fa-google">&nbsp;</i>
                                            Google
                                        </v-btn>
                                    </v-flex>
                                    <v-flex md6 class="text-xs-center">
                                        <v-spacer></v-spacer>
                                        <v-btn block class="grey--text elevation-0">
                                            <i class="fa fa-facebook">&nbsp;</i>
                                            Facebook
                                        </v-btn>
                                    </v-flex>
                                </v-layout>
                            </template> --}}
                            {{-- /Template --}}

                            <v-card-actions>
                                <v-btn class="ma-0" primary type="submit">{{ __("Login") }}</v-btn>
                                <v-spacer></v-spacer>
                                <v-btn class="ma-0" role="button" secondary outline href="{{ route('register.show') }}">{{ __('Create Account') }}</v-btn>
                            </v-card-actions>
                        </form>
                    </v-container>

                    <v-divider></v-divider>

                    <v-card-actions class="pa-3">
                        <v-spacer></v-spacer>
                        <a href="{{ route('register.show') }}">{{ __('Lost password?') }}</a>
                    </v-card-actions>
                </v-card>

                @stack('post-login')

                <div class="text-xs-center mt-1 mb-4">
                    <small class="grey--text">{{ __($application->site->copyright) }}</small>
                </div>

            </v-flex>
        </v-layout>
    </v-card>

@endsection

@push('post-css')
    <style>
        .card--flex-toolbar--stylized {
            margin-top: -65px;
        }
    </style>
    {{-- <style>
        @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);.card--flex-toolbar--stylized{margin-top:-64px}.hr{text-align:center;position:relative}.hr:after,.hr:before{content:"";display:block;width:40%;height:1px;margin:2px 1rem;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);background-color:rgba(0,0,0,.15)}.hr:after{text-align:left;position:absolute;left:0}.hr:before{position:absolute;text-align:right;right:0}[class*=application-] .color--google:hover{background-color:#db3236;color:#fff}[class*=application-] .color--facebook:hover{background-color:#3a589e;color:#fff}
        /*# sourceMappingURL=login.css.map*/
    </style> --}}
@endpush

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
                    }
                };
            },
        });
    </script>
@endpush
