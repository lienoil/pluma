@extends("Theme::layouts.public")

@section("main-content")
<v-container fluid grid-list-lg>
  <v-layout row wrap fill-height>
    <template>
      @foreach ($resources->items() as $i => $resource)
      <v-flex lg3 md4>
            <v-card class="elevation-1 c-lift" height="100%">
              <v-layout column wrap fill-height class="ma-0">
                @if ($resource->enrolled)
                  <a class="td-n" href="{{ route('courses.single', $resource->slug) }}">
                @else
                  <a class="td-n" href="{{ route('courses.show', $resource->slug) }}">
                @endif
                  <v-card-media class="accent lighten-3" src="{{ $resource->backdrop }}" height="220px">
                      <v-container fill-height fluid class="white--text py-0">
                          <v-layout fill-height column wrap>
                              <v-card flat class="transparent">
                                  <v-toolbar card class="transparent">
                                      <v-spacer></v-spacer>
                                  </v-toolbar>
                              </v-card>
                              <v-spacer></v-spacer>
                              <v-card flat class="transparent">
                                  <v-card-actions class="py-3">
                                      <v-avatar class="elevation-4"  size="80px">
                                          <img src="{{ $resource->feature }}" alt="{{ $resource->title }}">
                                      </v-avatar>
                                      <v-spacer></v-spacer>
                                      {{-- If Enrolled --}}
                                      @if ($resource->enrolled)
                                        <v-chip small class="ml-0 green td-n white--text">{{ __('Enrolled') }}</v-chip>
                                      @endif

                                      {{-- /If Enrolled --}}
                                  </v-card-actions>
                              </v-card>
                          </v-layout>
                      </v-container>
                  </v-card-media>
                </a>
                {{-- Title --}}
                @if ($resource->enrolled)
                  <v-card-title>
                    <a href="{{ route('courses.single', $resource->slug) }}">{{ $resource->title }}</a>
                  </v-card-title>
                @else
                  <v-card-title>
                    <a href="{{ route('courses.show', $resource->slug) }}">{{ $resource->title }}</a>
                  </v-card-title>
                @endif
                <v-card-actions>
                  <div class="text-xs-center caption pa-1 grey--text" title="{{ __('Course code') }}">
                      <v-icon class="caption" left>class</v-icon>
                      <span>{{ $resource->code }}</span>
                  </div>
                  <div class="text-xs-center caption pa-1 grey--text" title="{{ __('Published date') }}">
                      <v-icon class="caption" left>fa-clock-o</v-icon>
                      <span>{{ $resource->created }}</span>
                  </div>
                </v-card-actions>
                {{-- Excerpt --}}
                <v-card-text class="grey--text text--darken-1 body-1" >{{ $resource->excerpt }}</v-card-text>
                 <v-spacer></v-spacer
              </v-layout>
          </v-card>
      </v-flex>
      @endforeach
    </template>
  </v-layout>
</v-container>
@endsection
@push('css')
    <style>
        .c-lift {
            transition: all .2s ease;
        }
        .c-lift:hover {
            -webkit-transform: translateY(-6px);
            transform: translateY(-6px);
            box-shadow: 0 1px 8px rgba(0,0,0,.2),0 3px 4px rgba(0,0,0,.14),0 3px 3px -2px rgba(0,0,0,.12) !important;
        }
        .td-n:hover {
            text-decoration: none !important;
        }
    </style>
@endpush

