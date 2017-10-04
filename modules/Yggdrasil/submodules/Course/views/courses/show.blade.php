@extends("Theme::layouts.admin")

@section("head-title", __($resource->title))
@section("utilitybar", '')

@section("content")
    <v-parallax class="elevation-1 mb-3" src="{{ $resource->feature }}" height="350">
        <v-layout row wrap align-end justify-center>
            <v-flex md8 xs12 pa-0>
                <v-card tile flat class="mt-5">
                    <v-toolbar card class="white">
                        <v-spacer></v-spacer>
                        <v-chip small class="ml-0 green white--text">{{ __('Enrolled') }}</v-chip>
                        <v-btn icon ripple v-tooltip:left="{ html: 'Add to Bookmark' }">
                            <v-icon light>bookmark_border</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <v-container fluid grid-list-lg>
                        <v-flex sm12>
                            <v-layout row>
                                <v-flex md3 sm2>
                                    <v-card-media
                                        src="{{ $resource->feature }}"
                                        height="130px"
                                        cover
                                        class="elevation-1"
                                        >
                                    </v-card-media>
                                </v-flex>
                                <v-flex md9 sm10>
                                    <div class="accent--text headline">{{ $resource->title }}</div>
                                    <span class="grey--text subheading"><v-icon left>class</v-icon><span>{{ $resource->code }}</span></span>
                                    <span class="grey--text subheading"><v-icon left>fa-leaf</v-icon> <span>{{ $resource->lessons_count }}</span></span>
                                    @if ($resource->category)
                                        <span class="grey--text subheading"><v-icon left>label</v-icon> <span>{{ $resource->category->name }}</span></span>
                                    @endif
                                </v-flex>
                            </v-layout>
                        </v-flex>
                    </v-container>
                </v-card>
            </v-flex>
        </v-layout>
    </v-parallax>
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm8>
                <v-card class="elevation-1">
                    <v-toolbar card class="white">
                        <v-toolbar-title class="subheading"><strong>{{ __('Description') }}</strong></v-toolbar-title>
                    </v-toolbar>
                    <v-card-text class="grey--text text--darken-1">{!! $resource->body !!}</v-card-text>
                    <v-divider></v-divider>
                    <v-toolbar card class="white">
                        <v-toolbar-title class="subheading"><strong>{{ __('Course Content') }}</strong></v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        @foreach ($resource->lessons as $lesson)

                            <v-card class="elevation-1 mb-3" :class="{'locked': '{{ $lesson->isLocked() }}'}">
                                <v-toolbar card class="transparent">
                                    @if ($lesson->isLocked())
                                        <v-icon class="grey--text text--darken-1" left>fa-lock</v-icon>
                                    @endif
                                    <v-toolbar-title class="subheading">
                                        <div><strong>{{ $lesson->title }}</strong></div>
                                    </v-toolbar-title>
                                </v-toolbar>

                                <v-card-text class="grey--text text--darken-1">{!! $resource->body !!}</v-card-text>
                                @if (! $lesson->isLocked())
                                <v-divider></v-divider>

                                <v-stepper v-model="ee" vertical non-linear class="elevation-0">
                                    @foreach ($lesson->contents()->orderBy('sort')->get() as $i => $content)
                                        <v-stepper-step edit-icon="check" :editable="{{ $content->isLocked() ? 'false' : 'true' }}" step="{{ $content->sort+1 }}" :complete="{{ $content->isLocked() ? 'false' : 'true' }}">
                                            {{ $content->title }}
                                        </v-stepper-step>
                                        <v-stepper-content step="{{ $content->sort+1 }}">
                                            <v-card flat>
                                                <v-card-text class="grey--text">
                                                    {!! $content->body !!}
                                                    <v-divider></v-divider>
                                                    <br>
                                                    <v-card-media src="{{ url($content->library->thumbnail) }}" height="250px">
                                                        <v-container fill-height class="pa-0 white--text">
                                                            <v-layout fill-height wrap column>
                                                                <v-spacer></v-spacer>
                                                                <v-card-title>
                                                                    <v-spacer></v-spacer>
                                                                    @if (! $content->isLocked())
                                                                        <v-btn href="#sd" class="display-4" x-large icon><v-icon x-large dark>play_circle_filled</v-icon></v-btn>
                                                                    @endif
                                                                    <v-spacer></v-spacer>
                                                                </v-card-title>
                                                                <v-spacer></v-spacer>
                                                                <v-card-actions class="white--text">
                                                                    <v-spacer></v-spacer>
                                                                    <v-icon dark left>extension</v-icon>
                                                                    <span>Interactive</span>
                                                                </v-card-actions>
                                                            </v-layout>
                                                        </v-container>
                                                    </v-card-media>
                                                </v-card-text>
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn primary class="elevation-1" disabled>{{ __('Next') }}</v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-stepper-content>
                                    @endforeach
                                </v-stepper>
                                @endif
                                <v-card-actions>
                                    {{-- <div class="caption grey--text">
                                        <template>
                                            <v-icon class="caption" left>book</v-icon>
                                            <a href="#" @click.stop="lesson.dialog = !lesson.dialog">{{ $lesson->contents_count }}</a>
                                        </template>

                                        @if ($lesson->assignment)
                                            <v-icon left class="caption">fa-edit</v-icon>
                                            <span v-html="`{{ __('Assignment') }}: {{ $lesson->assignment->title }}`"></span>
                                        @endif
                                    </div> --}}
                                    <v-spacer></v-spacer>
                                    <v-dialog v-model="lesson.dialog" persistent fullscreen transition="dialog-bottom-transition">
                                        <v-btn slot="activator" flat class="green green--text">{{ 'View' }}</v-btn>
                                        <v-card flat tile>
                                            <v-toolbar dense dark card class="elevation-1 green lighten-1">
                                                <v-spacer></v-spacer>
                                                <v-btn dark icon @click="lesson.dialog = !lesson.dialog"><v-icon>close</v-icon></v-btn>
                                            </v-toolbar>

                                            @foreach ($lesson->contents as $content)
                                                <span>{{ $content->title }}</span>
                                            @endforeach
                                        </v-card>
                                    </v-dialog>
                                    {{-- <v-spacer></v-spacer> --}}
                                </v-card-actions>
                            </v-card>
                        @endforeach

                        {{-- <v-expansion-panel popout>
                            @foreach ($resource->lessons as $lesson)
                                <v-expansion-panel-content>
                                    <v-toolbar slot="header" card class="transparent">
                                        <v-toolbar-title class="subheading">{{ $lesson->title }}</v-toolbar-title>
                                    </v-toolbar>
                                    <v-card class="white">

                                        <v-card-text class="grey--text">{!! $lesson->body !!}</v-card-text>

                                        <v-divider></v-divider>

                                        <v-stepper v-model="ee" vertical non-linear class="elevation-0">
                                            @foreach ($lesson->contents()->orderBy('sort')->get() as $i => $content)
                                                <v-stepper-step :editable="{{ $content->completed }}" step="{{ $lesson->sort+1 }}+{{ $content->sort+1 }}" :complete="false">
                                                    {{ $content->title }}
                                                </v-stepper-step>
                                                <v-stepper-content step="{{ $lesson->sort+1 }}+{{ $content->sort+1 }}">
                                                    <v-card flat>
                                                        <v-card-text class="grey--text">
                                                            {!! $content->body !!}
                                                            <v-divider></v-divider>
                                                            <br>
                                                            <v-card-media src="{{ url($content->library->thumbnail) }}" height="250px">
                                                                <v-container fill-height class="pa-0 white--text">
                                                                    <v-layout fill-height wrap column>
                                                                        <v-spacer></v-spacer>
                                                                        <v-card-title>
                                                                            <v-spacer></v-spacer>
                                                                            <v-btn class="display-4" x-large icon><v-icon x-large dark>play_circle_filled</v-icon></v-btn>
                                                                            <v-spacer></v-spacer>
                                                                        </v-card-title>
                                                                        <v-spacer></v-spacer>
                                                                        <v-card-actions class="white--text">
                                                                            <v-spacer></v-spacer>
                                                                            <v-icon dark left>extension</v-icon>
                                                                            <span>Interactive</span>
                                                                        </v-card-actions>
                                                                    </v-layout>
                                                                </v-container>
                                                            </v-card-media>
                                                        </v-card-text>
                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <v-btn flat v-if="{{ $content->completed == true }}" primary @click.native="ee = '{{ $lesson->sort+1 }}+{{ $content->sort+2 }}'">{{ __('Next') }}</v-btn>
                                                        </v-card-actions>
                                                    </v-card>
                                                </v-stepper-content>
                                            @endforeach
                                        </v-stepper>

                                    </v-card>
                                </v-expansion-panel-content>
                            @endforeach
                        </v-expansion-panel> --}}
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .locked * {
            color: rgba(0,0,0,0.2) !important;
        }
    </style>
@endpush

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    ee: 1,
                    lesson: {
                        dialog: false
                    },
                    resource: {!! json_encode($resource->toArray()) !!}
                }
            },

            mounted () {
                for (var i = 0; i < this.resource.length; i++) {
                    this.resource[i].dialog = false;
                }
            }
        });
    </script>
@endpush
