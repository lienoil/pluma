@extends("Theme::layouts.admin")

@section("main-content")
  <v-container fluid grid-list-lg>
    <v-flex sm12>
      <h1>{{ $resource->title }}</h1>

      <p>Lessons:</p>
      <ul>
        @foreach ($resource->lessons as $lesson)
          <li>
            <a name="{{ $lesson->code }}"></a>
            {{ $lesson->title }}
            <v-btn small href="#{{ $lesson->next }}">Next</v-btn>
            <ul>
              @foreach ($lesson->children as $chapter)
                <li>
                  <a name="{{ $chapter->code }}"></a>
                  {{ $chapter->title }}
                  <v-btn small>Next</v-btn>
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>
    </v-flex>
  </v-container>

@endsection
