@extends("Theme::layouts.admin")

@section("main-content")
    <v-container>
      <v-layout row wrap>
        <v-flex xs12>
          <v-card>
            <v-card-title>
              {{ __('Timesheet') }}
            </v-card-title>
            <v-card-text>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla ipsum soluta dolor tempore quod nam, possimus sapiente veritatis quasi aliquam iste tenetur magni natus atque aperiam nesciunt eum ea consequatur.
            </v-card-text>
            @foreach ($resources as $resource)
              <v-card-text>
                <p><a href="{{ route('timesheets.show', $resource->id) }}">{{ $resource->dayname }}</a></p>
                <p>{{ $resource->dated }}</p>
                <p>{{ $resource->week }}</p>
                <p>{{ $resource->timein }}</p>
                <p>{{ $resource->timeout }}</p>
              </v-card-text>
            @endforeach
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
@endsection
