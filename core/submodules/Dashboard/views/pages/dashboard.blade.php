@extends("Theme::layouts.admin")

@section("main-content")
  @parent
  {{-- @include("Dashboard::partials.overview") --}}

  {{-- <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm6 md4>
        @foreach (widgets("dashboard.2.1", "location") as $widget)
          <v-card height="90px" class="mb-3"></v-card>
        @endforeach
      </v-flex>
    </v-layout>
  </v-container> --}}
@endsection
