@extends("Theme::layouts.auth")

@section("main")
  <v-jumbotron :gradient="`to top, ${$vuetify.theme.secondary} 80%, ${$vuetify.theme.secondary} 100%`" src="//source.unsplash.com/1080x600?nature" height="100vh">
    <v-container fluid fill-height>
      <v-layout row wrap justify-center align-center>
        <v-flex lg3 md4 sm8 xs12 justify-center align-center>

          <v-slide-y-transition mode="in-out">
            <login-card
              v-show="sidebar.model"
              logo="{{ $application->site->logo }}"
              title="{{ $application->site->title }}"
              subtitle="{{ $application->site->tagline }}"
            ></login-card>
          </v-slide-y-transition>

        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
@endsection
