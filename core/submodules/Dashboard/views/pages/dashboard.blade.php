@extends("Theme::layouts.admin")

@section("main-content")
  {{-- @parent --}}
  {{-- @include("Dashboard::partials.overview") --}}
  <v-container v-if="!$root.$router.current" fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm6 md5>
          <v-card class="mb-3 elevation-2">
            <v-system-bar window color="primary">
              <v-spacer></v-spacer>
              <v-icon role="button">close</v-icon>
            </v-system-bar>
            <v-card-text>
              <p class="caption mb-2 primary--text"><strong>{{ $application->pluma->fullcopy }}</strong></p>
              <h3 class="title mb-3"><v-icon left>loyalty</v-icon>Welcome to the New Dashboard!</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis dolores obcaecati harum libero, molestiae, ipsum pariatur ad mollitia sit iusto velit ea magnam deleniti fugiat ut, praesentium at aliquid ducimus!</p>
              <p><strong>Wan't to take the tour?</strong></p>
            </v-card-text>
            <v-card-actions v-text-actions>
              <v-spacer></v-spacer>
              <v-btn flat>{{ __('No, Thanks') }}</v-btn>
              <v-btn color="primary">{{ __('Get Started') }}</v-btn>
            </v-card-actions>
          </v-card>
      </v-flex>
    </v-layout>
  </v-container>
  <template v-else>
    <router-view></router-view>
  </template>

@endsection
