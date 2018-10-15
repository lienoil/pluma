@extends("Theme::layouts.public")

@section("head-title", $resource->title)

@section("main-content")
  <v-parallax class="elevation-1" src="{{ $resource->backdrop }}" height="100%">
    @if ($resource->enrolled)
    <v-toolbar class="elevation-0 transparent">
      @if ($resource->enrolled)
        <v-chip small class="ml-0 green white--text">{{ __('Enrolled') }}</v-chip>
      @endif
      @if ($resource->bookmarked)
          <form action="{{ route('courses.bookmark.unbookmark', $resource->id) }}" method="POST">
              {{ csrf_field() }}
              <v-btn type="submit" icon ripple v-tooltip left="{ html: '{{ __('Remove from your Bookmarks') }}' }">
                  <v-icon light class="red--text">bookmark</v-icon>
              </v-btn>
          </form>
      @endif
      <v-spacer></v-spacer>
      <v-menu full-width>
        <v-btn slot="activator" icon v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
        <v-list>
        {{-- @can('bookmark-course') --}}
            @if (! $resource->bookmarked)
                <v-list-tile avatar ripple @click="$refs.bookmark_form.submit()">
                    <v-list-tile-avatar>
                        <v-icon class="red--text">bookmark_outline</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-title>
                        <form
                            ref="bookmark_form" action="{{ route('courses.bookmark', $resource->id) }}"
                            method="POST">
                            {{ csrf_field() }}
                            {{ __('Bookmark this Course') }}
                        </form>
                    </v-list-tile-title>
                </v-list-tile>
            @else
                <v-list-tile avatar ripple @click="$refs.unbookmark_form.submit()">
                    <v-list-tile-avatar>
                        <v-icon class="red--text">bookmark</v-icon>
                    </v-list-tile-avatar>
                    <v-list-tile-title>
                        <form ref="unbookmark_form" action="{{ route('courses.bookmark.unbookmark', $resource->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ __('Remove from your Bookmarks') }}
                        </form>
                    </v-list-tile-title>
                </v-list-tile>
            @endif
        {{-- @endcan --}}
        </v-list>
      </v-menu>
    </v-toolbar>
    @endif
    <v-layout row wrap align-center justify-center>
      <v-flex md11 xs12>
          <v-card flat class="transparent text-md-left text-sm-center text-xs-center">
              <v-card-text class="py-5">
                  <v-layout row wrap align-center justify-center>
                      <v-flex md4 xs12>
                          <v-card flat class="transparent text-sm-center">
                              <v-avatar size="250px" class="my-3">
                                  <img src="{{ $resource->feature }}" width="100%">
                              </v-avatar>
                          </v-card>
                      </v-flex>
                      <v-flex md8 xs12>
                          <v-card dark flat class="transparent">
                              <h2 class="display-1"><strong>{{ $resource->title }}</strong></h2>

                              <v-chip dark label small class="pl-0 white--text ma-0 subheading transparent elevation-0">
                                  <v-icon left small class="subheading">fa-tasks</v-icon>&nbsp;
                                  <span>{{ $resource->lessons->count() }} {{ $resource->lessons->count() <= 1 ? __('Part') : __('Parts') }}</span>
                              </v-chip>

                              <v-chip dark label small class="white--text ma-0 subheading transparent elevation-0"><v-icon left small class="subheading">class</v-icon><span>{{ $resource->code }}</span></v-chip>

                              <v-chip dark label small class="white--text ma-0 subheading transparent elevation-0"><v-icon left small class="subheading">fa-clock-o</v-icon><span>{{ $resource->created }}</span></v-chip>

                              @if ($resource->category)
                                  <v-chip label class="ma-0 white--text subheading transparent elevation-0"><v-icon left small class="subheading">label</v-icon><a class="td-n white--text" target="_blank" href="{{ route('courses.all', ['category_id' => $resource->category->id]) }}">{{ $resource->category->name }}</a></v-chip>
                              @endif
                          </v-card>
                      </v-flex>
                  </v-layout>
              </v-card-text>
          </v-card>
      </v-flex>
    </v-layout>
  </v-parallax>
    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex md xs12 order-lg>
                <v-card class="mb-3 elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="page-title accent--text">{{ __('Overview') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text class="quill-text grey--text text--darken-2 page-content body-1">{!! $resource->body !!}</v-card-text>
                    <v-card-text class="text-xs-center">
                        <v-btn
                            secondary
                            class="elevation-1"
                            {{-- href="{{ $resource->first_content }}" --}}
                            >
                            {{ __('Start this course') }}
                        </v-btn>
                    </v-card-text>
                </v-card>
                @includeIf("Badge::widgets.badge")
            </v-flex>

            <v-flex md3 xs12 order-lg3>
                {{-- Enrolled Students --}}
                @include("Course::widgets.students")
                {{-- Enrolled Students --}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ assets('course/css/course.css') }}?v={{ app()->version() }}">
    <style>
        .course-grad {
            /*background: linear-gradient(45deg, #03A9F4 0%, #009688 100%);*/
            background: linear-gradient(45deg, #00BCD4  0%, #3F51B5 100%);
        }
        .quill-text h1, h2, h3, h4, h5, h6 {
            font-size: 25px !important;
            line-height: 30px !important;
        }
    </style>
@endpush
