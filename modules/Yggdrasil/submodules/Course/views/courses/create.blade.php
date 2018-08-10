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
        <form action="{{ route('courses.store') }}" method="POST">
          {{ csrf_field() }}
          Title : <input type="text" name="title">
          <br>
          Slug : <input type="text" name="slug">
          <br>
          Code : <input type="text" name="code">
          <br>
          Feature : <input type="text" name="feature">
          <br>
          Backdrop : <input type="text" name="backdrop">
          <br>
          Body : <input type="text" name="body">
          <br>
          <button type="submit">Submit</button>
        </form>
      </v-flex>
    </v-layout>
  </v-container>
@endsection
