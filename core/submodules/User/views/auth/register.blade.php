@extends("Theme::layouts.auth")

@section("main")
  {{-- @parent --}}
  <v-jumbotron :gradient="`to top right, #022242 10%, #420224 100%`" height="100%">
    <v-container fluid fill-height>
      <v-layout row wrap align-center justify-center>
        {{-- <v-flex lg5 md3 sm8 xs12>
          <v-card v-scrollable height="100%" style="border-top-right-radius:0;border-bottom-right-radius:0">
            <v-layout column wrap fill-height>
              <v-card-text class="pa-4">
                <v-layout column wrap justify-center align-center>
                  <img src="{{ $application->site->logo }}" width="120px">
                  <h1 class="title primary--text">{{ $application->site->title }}</h1>
                  <p class="body-1">{{ $application->page->body ?? $application->site->tagline }}</p>
                </v-layout>
                <p class="headline">{{ __('Joining is easy. Signup now for free and have access to both free and paid courses to help you win at life!') }}</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad temporibus aliquid quidem doloribus maiores, accusantium cupiditate totam eum culpa iusto rerum quas animi, nihil expedita. Reiciendis, optio non illo soluta!</p>
                <p class="body-2">
                  {{ __('Already have an account?') }}
                  <a href="{{ route('login.show') }}">{{ __('Login here.') }}</a>
                </p>
              </v-card-text>
              <v-spacer></v-spacer>
              <v-card-actions class="grey lighten-3 grey--text text--darken-1">
                <small class="caption">{!! $application->site->copyright !!}</small>
              </v-card-actions>
            </v-layout>
          </v-card>
        </v-flex> --}}
        <v-flex lg3 md4 sm8 xs12>

          @if (request()->get('padding') == 3)
            <v-slide-y-transition mode="in-out">
              <register-card
                color="primary"
                class="pa-3"
                height="100%"
                {{-- logo="{{ $application->site->logo }}"
                subtitle="{{ $application->site->tagline }}" --}}
                title="{{ __('Create an account') }}"
              ></register-card>
            </v-slide-y-transition>
          @elseif (request()->get('padding') == 2)
            <register-card
              color="primary"
              class="pa-2"
              height="100%"
              {{-- logo="{{ $application->site->logo }}"
              subtitle="{{ $application->site->tagline }}" --}}
              title="{{ __('Create an account') }}"
            ></register-card>
          @else
            <register-card
              color="primary"
              height="100%"
              {{-- logo="{{ $application->site->logo }}"
              subtitle="{{ $application->site->tagline }}" --}}
              title="{{ __('Create an account') }}"
            >
              <v-card-title slot="header" slot-scope="props">
                <h1 class="title" v-html="props.title"></h1>
              </v-card-title>
            </register-card>
          @endif

        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
@endsection
