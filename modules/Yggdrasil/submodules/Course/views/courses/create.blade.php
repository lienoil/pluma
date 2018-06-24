@extends("Theme::layouts.admin")

@section("main-content")
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm12>
        <p class="mb-0"><strong><small>{{ $resource->code }}</small></strong></p>
        <h1 class="title">{{ $resource->title }}</h1>
        <p>Overview:</p>
        <ul class="pl-2">
          @foreach ($resource->lessons as $lesson)
            <li>
              <h3 class="headline">{{ $lesson->id }} | {{ $lesson->title }}</h3>
              <ul class="pl-4">
                @foreach ($lesson->children as $part)
                  <li>{{ $part->title }}</li>
                @endforeach
              </ul>
            </li>
          @endforeach
        </ul>
      </v-flex>
    </v-layout>
  </v-container>
@endsection
