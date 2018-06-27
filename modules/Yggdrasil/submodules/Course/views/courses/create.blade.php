@extends("Theme::layouts.admin")

@section("main-content")
  <v-container fluid grid-list-lg>
    <v-layout row wrap>
      <v-flex sm12>
        <p class="mb-0"><strong><small>{{ $resource->code }}</small></strong></p>
        <h1 class="title mb-3">{{ $resource->title }}</h1>
        <p class="mb-0">Overview:</p>
        <ul class="pl-4">
          @php
            // dd(
            //   $resource->lessons()->find(4)->first()->children->pluck('title')
            // );
          @endphp
          @foreach ($resource->children as $lesson)
            <li class="py-1">
              <h3 class="headline">{{ $lesson->id }} - {{ $lesson->title }} | Parent: {{ $lesson->_parent }}</h3>
              {{-- <ul class="pl-4">
                @foreach ($lesson->descendants as $part)
                  <li class="py-1">
                    {{ $part->id }} - {{ $part->title }}

                    <ul class="pl-4">
                      @foreach ($part->children as $child)
                        <li class="py-1">
                          {{ $child->id }} - {{ $child->title }}

                          <ul class="pl-4">
                            @foreach ($child->children as $granchild)
                              <li class="py-1">{{ $granchild->id }} - {{ $granchild->title }}</li>
                            @endforeach
                          </ul>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                @endforeach
              </ul> --}}
            </li>
          @endforeach
        </ul>
      </v-flex>
    </v-layout>
  </v-container>
@endsection
