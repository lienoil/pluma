@extends("Theme::layouts.admin")

@section("head-title", __($resource->title))
@section("utilitybar", '')

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <v-parallax class="elevation-1 mb-3" src="{{ $resource->feature }}" height="auto">
                    <v-layout row wrap align-end justify-center>
                        <v-flex md8 xs12 pa-0>
                            <v-card tile flat class="mt-5">
                                <v-toolbar card class="white">
                                    <v-spacer></v-spacer>
                                    <v-chip small class="ml-0 green white--text"> Enrolled </v-chip>
                                    <v-btn icon ripple v-tooltip:left="{ html: 'Add to Bookmark' }">
                                        <v-icon light>bookmark_border</v-icon>
                                    </v-btn>
                                    <v-menu bottom left>
                                        <v-btn icon ripple slot="activator" v-tooltip:left="{ html: 'More Actions' }">
                                            <v-icon light>more_vert</v-icon>
                                        </v-btn>
                                        <v-list>
                                            <v-list-tile @click="" ripple>
                                                <v-list-tile-action>
                                                    <v-icon accent>edit</v-icon>
                                                </v-list-tile-action>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>
                                                        Edit
                                                    </v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                            <v-list-tile @click="" ripple>
                                                <v-list-tile-action>
                                                    <v-icon warning>delete</v-icon>
                                                </v-list-tile-action>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>
                                                        Move to Trash
                                                    </v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                        </v-list>
                                    </v-menu>
                                </v-toolbar>
                                <v-card-text class="pt-0">
                                    <v-flex sm12>
                                        <v-layout row>
                                            <v-flex md2 sm2 xs2>
                                                <v-card-media
                                                    src="http://localhost:8000/storage/uploads/08-15-17/a.png"
                                                    height="125px"
                                                    cover
                                                    class="elevation-1"
                                                    >
                                                </v-card-media>
                                            </v-flex>
                                            <v-flex md10 xs12>
                                                <div>
                                                    <div class="headline">{{ $resource->title }}</div>
                                                </div>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-parallax>
            </v-flex>
        </v-layout>

        <v-layout row wrap>
            <v-flex sm8>
                <v-card class="elevation-1 mb-3">
                    <v-card-title class="subheading">{{ __('Description') }}</v-card-title>
                    <v-card-text>
                        {!! $resource->body !!}
                    </v-card-text>
                </v-card>
                <v-card class="elevation-1">
                    <v-toolbar card class="white">
                        <v-toolbar-title class="subheading">{{ __('Course Content') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-expansion-panel popout>
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
                        </v-expansion-panel>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    ee: '1+1'
                }
            }
        });
    </script>
@endpush
