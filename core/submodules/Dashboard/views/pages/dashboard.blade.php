@extends("Theme::layouts.admin")

@section("main-content")
  {{-- @parent --}}
  {{-- @include("Dashboard::partials.overview") --}}

  <v-container v-if="!$root.$router.current" fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm6 md5>
          <v-card class="mb-3 elevation-2">
            <v-card-title class="pa-4">
              <span class="title">Welcome to the New Dashboard!</span>
              <v-spacer></v-spacer>
              <v-btn icon small><v-icon small>close</v-icon></v-btn>
            </v-card-title>
            <v-card-text class="grey--text text--darken-2 pa-4">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis dolores obcaecati harum libero, molestiae, ipsum pariatur ad mollitia sit iusto velit ea magnam deleniti fugiat ut, praesentium at aliquid ducimus!</p>
            </v-card-text>
            <v-card-actions class="grey lighten-4 py-3 px-4">
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
