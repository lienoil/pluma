@extends("Theme::layouts.admin")

@section("main-content")
  <v-container fluid grid-list-lg>
    <v-flex sm12>
      <v-card flat>
        {{-- <v-card-media src="{{ $resource->backdrop }}" height="250px"></v-card-media> --}}
      </v-card>
      <h1>{{ $resource->title }}</h1>

      <p>Lessons:</p>
      <ul>
        @foreach ($resource->lessons as $lesson)
          <li>
            <a name="{{ $lesson->code }}"></a>
            @if ($lesson->previous())
              <a href="#{{ $lesson->previous()->code }}">Previous</a>
            @endif
            {{ $lesson->id }} {{ $lesson->title }}
            @if ($lesson->next())
              <a href="#{{ $lesson->next()->code }}">Next</a>
            @endif
            <ul>
              @foreach ($lesson->children as $chapter)
                <li>
                  <a name="{{ $chapter->code }}"></a>


                  @if ($chapter->previous())
                    <a href="#{{ $chapter->previous()->code }}">Previous</a>
                  @endif
                  {{ $chapter->title }}
                  @if ($chapter->next())
                    <a href="#{{ $chapter->next()->code }}">Next</a>
                  @endif
                </li>
              @endforeach
            </ul>
          </li>
        @endforeach
      </ul>
      <br><br>
     <a href="{{ route('courses.bookmarked') }}">REQUEST COURSE</a>
      <br><br>
     <a href="{{ route('courses.my') }}">BOOKMARK COURSE</a>
    </v-flex>
  </v-container>

@endsection
