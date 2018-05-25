@extends("Theme::layouts.auth")

@section("main")
  @parent
  <v-jumbotron :gradient="`to top right, #022242 10%, #420224 100%`" height="100vh">
    <v-container fluid fill-height>
      <v-layout row wrap justify-center align-center>
        <v-flex lg3 md4 sm8 xs12 justify-center align-center>

          <v-slide-y-transition mode="in-out">
            <login-card
              color="primary"
              logo="{{ $application->site->logo }}"
              subtitle="{{ $application->site->tagline }}"
              title="{{ $application->site->title }}"
            ></login-card>
          </v-slide-y-transition>

        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
@endsection
