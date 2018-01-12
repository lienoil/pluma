@extends("Theme::layouts.auth")

@section("content")
    <main id="main" class="main">
        <v-container fluid fill-height>
            <v-layout fill-height column wrap justify-center align-center>
                <v-flex lg6 md10 sm10 xs12 fill-height justify-center align-center>

                    @include("Theme::partials.banner")

                    <v-card class="elevation-1 mb-3">
                        <v-layout row wrap>
                            <v-flex md5 xs12 class="teal accent-4">
                                <v-layout row wrap justify-center align-center>
                                    <v-flex xs12>
                                        <v-card class="elevation-0 transparent white--text" height="100%">
                                            <v-card-text class="text-xs-center">
                                                <v-layout row wrap justify-center align-center>
                                                    <v-flex xs12>
                                                        <p><img src="{{ settings('login_logo', assets('frontier/images/placeholder/paper-pencil-magnifier.svg')) }}" alt="" width="150"></p>
                                                        <h4>{{ "Password Recovery" }}</h4>
                                                        <p>{{ __("We need you to verify your email address so you can proceed in resetting your forgotten password.") }}</p>
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
                                                {{ $application->page->title }}
                                            </v-toolbar-title>
                                            <v-spacer></v-spacer>
                                        </v-toolbar>
                                        <v-divider></v-divider>
                                        <v-card-text>
                                            <v-card flat>
                                                <v-card-text class="pa-0">
                                                    {{--  --}}
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

                </v-flex>
            </v-layout>
        </v-container>
    </main>

    {{-- <div class="container-fluid">
        <div class="col-md-4 col-md-offset-4 m-t-4">

            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.reset') }}">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header box-header with-border">
                        <h3 class="card-title">Reset Password</h3>
                    </div>

                    <div class="panel-body">

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

@endsection