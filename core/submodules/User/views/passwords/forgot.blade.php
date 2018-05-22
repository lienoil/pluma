@extends("Theme::layouts.auth")

@section("main")
  <v-jumbotron height="100vh">
    <v-container fluid fill-height>
      <v-layout row wrap justify-center>
        <v-flex lg6 sm8 xs12 justify-center>

          @include("Theme::partials.banner")

          <v-card flat color="transparent" class="mt-5">
            <v-card-title class="headline" v-html="trans('Forgot your password?')"></v-card-title>
            <v-card-text>
              <p class="subheading">@{{ trans("Don't worry. Resetting your password is easy, just tell us the email address you registered with us.") }}</p>

              <v-form action="{{ route('password.send') }}" method="POST">
                {{ csrf_field() }}
                <v-text-field v-title v-focus solo name="email" hide-details prepend-icon="email" :placeholder="trans('email@domain.com')" class="mb-3" type="email"></v-text-field>
                @if ($errors->has('email'))
                  <div class="mb-3 caption error--text">{{ $errors->first('email') }}</div>
                @endif
                <div>
                  <v-btn large type="submit" class="ma-0" color="primary">@{{ trans("Send Reset Link") }}</v-btn>
                </div>
              </v-form>

              <v-card-actions class="px-0 mt-4 caption grey--text">
                <a class="grey--text" href="{{ route('login.show') }}">{{ __('Login') }}</a>
                <span>{{ __('or') }}</span>
                <a class="grey--text" href="{{ route('register.show') }}">{{ __('Signup') }}</a>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card-text>
          </v-card>

        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
@endsection
