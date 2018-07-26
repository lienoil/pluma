@extends("Theme::layouts.admin")

@section("main-content")
  {{-- <v-jumbotron src="{{ $resource->feature }}" height="180px"></v-jumbotron> --}}
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm12>{{--
        <p class="mb-0"><strong><small>{{ $resource->code }}</small></strong></p>
        <h1 class="title mb-3">{{ $resource->title }}</h1>

        {!! $resource->body !!}

        <p class="mb-0">Overview:</p>
        <ul class="pl-4">
          @php
            // dd(
            //   $resource->lessons()->find(4)->first()->children->pluck('title')
            // );
          @endphp
          @foreach ($resource->children as $i => $lesson)
            <li class="py-1">
              <h3 class="headline">
                <v-icon>play_arrow</v-icon>
                {{ $lesson->id }} - {{ $lesson->ancestor_id }} : {{ $lesson->title }}
              </h3>
              <ul class="pl-4">
                @foreach ($lesson->children as $part)
                  <li class="py-1">
                    <v-icon>attach_file</v-icon>
                    {{ $part->id }} - {{ $lesson->ancestor_id }} : {{ $part->title }}

                    <ul class="pl-4">
                      @foreach ($part->children as $child)
                        <li class="py-1">
                          <v-icon>developer_mode</v-icon>
                          {{ $child->id }} - {{ $lesson->ancestor_id }} : {{ $child->title }}

                          <ul class="pl-4">
                            @foreach ($child->children as $grandchild)
                              <li class="py-1">{{ $grandchild->id }} - {{ $grandchild->title }}</li>
                            @endforeach
                          </ul>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                @endforeach
              </ul>
            </li>
          @endforeach
        </ul> --}}
        <form action="{{ route('api.courses.store') }}" method="POST">
          {{ csrf_field() }}
          <input type="text" name="api_token" value="{{ user()->token }}">
          <br>
          Title : <input type="text" name="title" value="posdaowe12120d">
          <br>
          Slug : <input type="text" name="slug" value="posdaowe12120d">
          <br>
          Code : <input type="text" name="code" value="posdaowe12120d">
          <br>
          Feature : <input type="text" name="feature" value="posdaowe12120d">
          <br>
          Backdrop : <input type="text" name="backdrop" value="posdaowe12120d">
          <br>
          Body : <input type="text" name="body" value="posdaowe12120d">
          <br>
          <input type="text" name="lessons[0][title]" value="">
          <button type="submit">Submit</button>
        </form>
      </v-flex>
    </v-layout>
  </v-container>
@endsection
