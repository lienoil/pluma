@extends("Frontier::layouts.auth")

@section("content")
    <v-card class="grey lighten-5" flat>
        <v-toolbar dark class="primary elevation-0" extended></v-toolbar>
        <v-layout>
            <v-flex sm4 md5 offset-sm2>

                @include("Frontier::partials.alert")

                <form method="POST" action="{{ route('login.login') }}">
                    <v-card class="card--flex-toolbar card--flex-toolbar--stylized" transition="slide-x-transition">
                        <v-toolbar card class="white" prominent>
                            <v-toolbar-title>{{ __($application->head->title) }} <span class="grey--text">{{ __($application->site->title) }}</span></v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>
                        <v-divider></v-divider>
                        <v-card-text>
                            <v-layout row>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <v-flex>
                                    <v-text-field
                                        :hint="'{{ $errors->has('username')?$errors->first('username'):'' }}'"
                                        class="input-group"
                                        label="Email or username"
                                        name="username"
                                        persistent-hint
                                        type="text"
                                    ></v-text-field>
                                    <v-text-field
                                        :append-icon-cb="() => (visible = !visible)"
                                        :append-icon="visible ? 'visibility' : 'visibility_off'"
                                        :hint="'{{ $errors->has('password')?$errors->first('password'):'' }}'"
                                        :type="visible ? 'text': 'password'"
                                        class="input-group"
                                        label="Password"
                                        min="6"
                                        name="password"
                                        persistent-hint
                                    ></v-text-field>
                                    <v-checkbox
                                        :checked="remember"
                                        @click="() => {remember = !remember}"
                                        label="Remember Me"
                                        light
                                        v-model="remember"
                                    ></v-checkbox>
                                </v-flex>
                            </v-layout>
                            <v-layout>
                                <v-btn
                                    primary
                                    type="submit"
                                >
                                    <span>Login</span>
                                </v-btn>
                            </v-layout>


                            <template inline-template>
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
                            </template>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-text>
                            <v-layout row>
                                <v-flex>
                                    <a href="{{ route('register.show') }}" class="mr-3">Create Account</a>
                                    <a href="{{ route('register.show') }}" class="mr-3">Lost password?</a>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </form>

                <div class="copy">
                    <small class="grey--text">{{ __($application->site->copyright) }}</small>
                </div>

            </v-flex>
        </v-layout>
    </v-card>

@endsection

@push('post-css')
    <style>
        @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);.card--flex-toolbar--stylized{margin-top:-64px}.hr{text-align:center;position:relative}.hr:after,.hr:before{content:"";display:block;width:40%;height:1px;margin:2px 1rem;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);background-color:rgba(0,0,0,.15)}.hr:after{text-align:left;position:absolute;left:0}.hr:before{position:absolute;text-align:right;right:0}[class*=application-] .color--google:hover{background-color:#db3236;color:#fff}[class*=application-] .color--facebook:hover{background-color:#3a589e;color:#fff}
        /*# sourceMappingURL=login.css.map*/
    </style>
@endpush

@push('js')
    <script>
        let app = new Vue({
            el: 'v-app',
            data: {
                visible: false,
                remember: true,
            },
        });
    </script>
@endpush
