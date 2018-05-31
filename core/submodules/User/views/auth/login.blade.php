@extends("Theme::layouts.auth")

@section("main")
  {{-- @parent --}}
  <v-jumbotron class="grey lighten-3" :xgradient="`to top right, #022242 10%, #420224 100%`" height="100%">
    <v-container fluid fill-height>
      <v-layout row wrap justify-center align-center>
        <v-flex lg3 md4 sm8 xs12 justify-center align-center>

          <v-card class="mb-3">
            <v-card-title>
              <v-layout column wrap>
                <h1 class="subheading"><strong>Warlords of the Apocalypse</strong></h1>
                <span class="grey--text">Make love not war</span>
              </v-layout>
              <v-spacer></v-spacer>
              <v-btn icon><v-icon>more_vert</v-icon></v-btn>
            </v-card-title>
            <v-card-text>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</v-card-text>
            <v-card-actions>
              <v-btn color="primary">Read Now</v-btn>
              <v-btn color="primary" flat>Read Later</v-btn>
            </v-card-actions>
          </v-card>

          {{-- <v-slide-y-transition mode="in-out">
            <login-card
              box
              color="primary"
              logo="{{ $application->site->logo }}"
              subtitle="{{ $application->site->tagline }}"
              title="{{ $application->site->title }}"
            ></login-card>
          </v-slide-y-transition> --}}

        </v-flex>
      </v-layout>
    </v-container>
  </v-jumbotron>
@endsection
