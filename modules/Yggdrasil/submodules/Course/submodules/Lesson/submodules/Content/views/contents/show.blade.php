@extends("Theme::layouts.public")

@section("head-title", "{$resource->course->title} &#x276f; {$resource->lesson->title} &#x276f; {$resource->title}")

@push('post-meta')
    <link rel="manifest" href="{{ url('manifest.json') }}">
@endpush

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="mb-2 elevation-1">
                    {{-- <v-toolbar card dense class="transparent">
                        <v-toolbar-title class="title">{{ $resource->title }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="goFullscreen"><v-icon>@{{ fullscreen.model ? 'fullscreen' : 'fullscreen_exit' }}</v-icon></v-btn>
                    </v-toolbar> --}}

                    <v-alert
                        icon="check"
                        class="success ma-0"
                        dismissible
                        v-model="resource.completed"
                        transition="slide-y-transition"
                        :timeout="2000"
                        style="z-index: 2"
                        >
                        <v-card style="margin-bottom: -2rem" class="elevation-1 mb-2">
                            <v-card-text class="grey--text text--darken-1 text-xs-center">{{ __("You have already finished this part of the lesson. Though no data will be recorded, you may still view this lesson again.") }}</v-card-text>
                        </v-card>
                    </v-alert>

                    <template v-if="! resource.lesson.course.enrolled">
                        <div class="text-xs-center">
                            <img src="{{ assets('course/images/no-courses.png') }}" alt="{{ __('Not enrolled') }}">
                        </div>
                        <v-container fill-height class="pa-0 pb-4">
                            <v-layout fill-height wrap column>
                                <v-spacer></v-spacer>
                                <div class="subheading text-xs-center grey--text">
                                    <div class="mb-3 headline">{{ __("You are not enrolled to this course.") }}</div>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn class="primary primary--text" outline ripple @click="">{{ __("Request Course") }}</v-btn>
                                        <form v-if="!resource.lesson.course.bookmarked" action="{{ route("courses.bookmark.bookmark", $resource->lesson->course->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            <v-btn type="submit" class="red red--text" outline ripple><v-icon left>bookmark_outline</v-icon>{{ __("Bookmark") }}</v-btn>
                                        </form>
                                        <v-spacer></v-spacer>
                                    </v-card-actions>
                                </div>
                                <v-spacer></v-spacer>
                            </v-layout>
                        </v-container>
                    </template>
                    <template v-else>
                        <v-card flat class="grey--text text--darken-1" v-if="resource.locked">
                            <v-card-media height="480px">
                                <v-container fill-height fluid>
                                    <v-layout fill-height wrap column>
                                        <v-spacer></v-spacer>
                                        <v-icon class="display-4">lock</v-icon>
                                        <div class="pa-4 subheading text-xs-center">{{ __('This part is still locked. Please finish the previous interaction.') }}</div>
                                        <v-card-actions class="pa-0">
                                            <v-spacer></v-spacer>
                                            <v-btn dark class="secondary" ripple href="{{ $resource->playing }}"><v-icon left>arrow_back</v-icon>{{ __('Go to Current Lesson') }}</v-btn>
                                            <v-spacer></v-spacer>
                                        </v-card-actions>
                                        <v-spacer></v-spacer>
                                    </v-layout>
                                </v-container>
                            </v-card-media>
                        </v-card>
                        <template v-else>
                            <div id="interactive-container">
                                <v-fade-transition>
                                    <template>
                                        <div>
                                            {!! $resource->html !!}
                                            <v-dialog v-model="messagebox.model" width="60vw" persistent>
                                                <v-card flat tile class="text-xs-center">
                                                    <v-icon class="display-4 success--text">check</v-icon>
                                                    <v-card-text class="headline success--text text-xs-center">{{ __("Completed") }}</v-card-text>
                                                    <v-card-text class="grey--text text--darken-1">
                                                        {{ __("You have finished this Interaction. Click below to continue.") }}
                                                    </v-card-text>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <v-btn :disabled="messagebox.btnDiabled" primary @click="messagebox.model = !messagebox.model">{{ __("Okay") }}</v-btn>
                                                        <v-spacer></v-spacer>
                                                    </v-card-actions>
                                                </v-card>
                                            </v-dialog>
                                        </div>
                                    </template>
                                </v-fade-transition>
                            </div>
                        </template>
                    </template>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        @if ($resource->previous)
                            <v-btn success outline href="{{ $resource->previous }}"><v-icon success left>keyboard_arrow_left</v-icon> Previous</v-btn>
                        @else
                            <v-btn disabled success outline><v-icon left>keyboard_arrow_left</v-icon> Previous</v-btn>
                        @endif
                        @if ($resource->next)
                            <v-btn success outline href="{{ $resource->next }}"> Next <v-icon success right>keyboard_arrow_right</v-icon></v-btn>
                        @else
                            <v-btn disabled outline href="{{ $resource->next }}"> Next <v-icon right>keyboard_arrow_right</v-icon></v-btn>
                        @endif
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>

        <v-layout row wrap justify-center align-center>
            <v-flex lg10 md11 xs12>
                <v-layout row wrap>
                    <v-flex md8 xs12>

                        {{-- Description --}}
                        <v-card class="mb-3 elevation-1">
                            <v-card-text>
                                <h2 class="page-title display-1">{{ $resource->course->title }}</h2>
                                <h2 class="page-title headline grey--text">{{ $resource->title }}</h2>
                            </v-card-text>
                            <v-card-text>
                                {!! $resource->body !!}
                            </v-card-text>
                            <v-card-actions class="pa-3">
                                <p class="body-1 grey--text page-title mb-1">{{ __('PUBLISHED') }} {{ $resource->created }}</p>
                                <p class="subheading grey--text text--darken-1 body-1 page-title mb-1"> {{ __('on') }} <a target="_blank" href="{{ route('courses.single', $resource->course->slug) }}"><strong>{{ $resource->course->title }}</strong></a></p>
                            </v-card-actions>
                        </v-card>
                        {{-- Description --}}

                        {{-- Comments Section --}}
                        <v-card class="elevation-1">
                            @include("Content::widgets.comments")
                        </v-card>
                        {{-- Comments Section --}}
                    </v-flex>

                    <v-flex md4 xs12>
                        <v-card class="elevation-1 mb-3">
                            <v-toolbar flat class="transparent">
                                <v-toolbar-title class="page-title">{{ $resource->lesson->title }}</v-toolbar-title>
                            </v-toolbar>
                            <v-divider></v-divider>
                            <v-list class="mb-3">
                                {{-- @foreach ($resource->lesson->contents as $content)
                                    <v-list-tile
                                        href="{{ $content->url }}"
                                        ripple
                                    >
                                        <v-list-tile-action>
                                            @if ($content->completed)
                                                <v-icon left>check</v-icon>
                                            @elseif ($content->current)
                                                <v-icon left>play_circle_outline</v-icon>
                                            @else
                                                <v-icon left>lock</v-icon>
                                            @endif
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>{{ $content->title }}</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                @endforeach --}}
                                <v-list-tile
                                    :href="item.url"
                                    :key="i"
                                    ripple
                                    v-for="(item, i) in playlist"
                                    {{-- @click="openWindow(item.url)" --}}
                                    {{-- v-model="item.active" --}}
                                >
                                    <v-list-tile-action>
                                        <v-icon left v-if="item.completed" class="success--text">check</v-icon>
                                        <v-icon left v-else-if="item.current" class="grey--text">play_circle_outline</v-icon>
                                        <v-icon left v-else>lock</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title v-html="item.title"></v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                            </v-list>

                            {{-- Assignment --}}
                            <v-card-text>
                                @include("Content::widgets.assignment")
                            </v-card-text>
                            {{-- /Assignment --}}
                        </v-card>

                        {{-- Content Progress --}}
                            @include("Course::widgets.lesson-progress")
                        {{-- /Content Progress --}}
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@section("back-to-top", "")

@push('css')
    <style>
        .card::-webkit-full-screen,
        .card::-moz-full-screen
        .card::fullscreen {
            /*max-height: 100vh;
            width: 100vw;
            height: 100vh;
            overflow-y: auto;
            cursor: zoom-out;
            top: 0;
            left: 0;
            background: red !important;*/
        }

        .interactive-content {
            width: 100%;
            max-height: 100vh;
            display: block;
            text-align: center;
            margin: 0 auto;
        }
        .interactive-container--landscape .toolbar ~ div .interactive-content {
            height: calc(100vh - 48px);
        }
        .interactive-container--landscape .interactive-content {
            height: 100vh;
        }
        .interactive-container--landscape {
            /*position: fixed;*/
            /*max-height: 100vh;*/
            width: 100vw;
            height: 100vh !important;
            overflow: auto !important;
            top: 0;
            left: 0;
            padding: 0;
            margin: 0;
        }
        .course-content-grad {
            background: linear-gradient(45deg, #03A9F4 0%, #009688 100%);
        }
        .quill-text h1, h2, h3, h4, h5 {
            font-size: 20px !important;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    {{-- <script src="{{ assets('course/scorm/scormdriver.js') }}"></script> --}}
    {{-- <script src="{{ assets('course/scorm/scorm.6.0.0.js') }}"></script> --}}
    {{-- <script src="{{ assets('course/scorm/scorm.js') }}"></script> --}}
    <script src="{{ assets('course/scorm/scorm.adapter.api-1.2-2004.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    fullscreen: {
                        model: true
                    },
                    drawer: {
                        model: false,
                        items: {!! $contents !!}
                    },
                    messagebox: {
                        model: false,
                        type: 'success',
                        exit: false,
                        btnDiabled: false,
                    },
                    course: {
                        started: false,
                    },
                    resource: {!! json_encode($resource) !!},
                    previous: {!! json_encode($resource->previous) !!},
                    next: {!! json_encode($resource->next) !!},
                    scorm: null,
                    playlist: {!! json_encode($resource->lesson->contents) !!},
                    lesson_status_completed: false,
                }
            },
            methods: {
                openWindow (url) {
                    window.open(url, '_blank', 'location=yes,height=570,width=520,scrollbars=yes,status=yes');
                },

                playInteraction () {
                    // this.goFullscreen();
                    this.course.started = !this.course.started
                },
                unloadSCO () {
                    window.API.LMSCommit("");
                    return window.API.LMSFinish("");
                },

                goFullscreen() {
                    window.API.stage.fullscreen(document.querySelector('#interactive-container'));
                    this.fullscreen.model = !this.fullscreen.model;
                },

                lms () {
                    let self = this;

                    return {
                        exit () {
                            self.messagebox.btnDisabled = !self.messagebox.btnDisabled;
                            window.API.LMSFinish('');
                            // window.close();
                        },

                        get () {
                            window.API.on('BeforeInitialize', function (cache) {
                                // window.onload = function () {
                                    // var interactiveType = document.querySelector('.interactive-content').getAttribute('data-type');
                                    // if (interactiveType.match('image.*')) {
                                    //     window.API.LMSSetValue("cmi.core.lesson_status", 'completed');
                                    //     window.API.Cache().set("cmi.core.lesson_status", 'completed');
                                    //     let cache = JSON.parse(JSON.stringify(window.API.Cache().get()));
                                    //     self.$http.post(window.API.options.COMMIT, cache).then(response => {
                                    //         if (response.status === 200) {
                                    //             window.API.LMSFinish('');
                                    //             return "true";
                                    //         }
                                    //         return response.bodyText;
                                    //     });
                                    // }
                                // }

                                // Start getting the initial values from the LMS.
                                // This is done in the custom (non-SCORM) function BeforeInitialize, because the request
                                // is asynchronous.
                                if (! self.resource.locked) {
                                    // self.$http.post('{{ route('api.scorm.lmsinitialize', [$resource->lesson->course->id, $resource->id]) }}', {_token: '{{ csrf_token() }}'}).then(response => {
                                    //     window.API.Cache().setMultiple(response.body);
                                    //     window.API.Cache().set("cmi.core.student_name", '{{ user()->displayname }}');
                                    //     window.API.Cache().set("cmi.core.student_id", '{{ user()->id }}');
                                    // });
                                }
                            });

                            // Initialize the API with options.
                            window.API.init('{{ $resource->version }}', {
                                _token: '{{ csrf_token() }}',
                                debug: false, //'{{ env('APP_DEBUG') ?? 'false' }}',
                                COMMIT: '{{ route('api.scorm.lmscommit', [$resource->lesson->course->id, $resource->id]) }}',
                                FINISH: '{{ route('api.scorm.lmsfinish', [$resource->lesson->course->id, $resource->id]) }}',
                                GET: '{{ route('api.scorm.lmsgetvalue', [$resource->lesson->course->id, $resource->id]) }}',
                                INIT: '{{ route('api.scorm.lmsinitialize', [$resource->lesson->course->id, $resource->id]) }}',
                                POST: '{{ route('api.scorm.lmssetvalue', [$resource->lesson->course->id, $resource->id]) }}',
                            });
                        },
                        mounted () {
                            //
                            window.API.on('LMSInitialize', function (dummyString, cache) {
                                // window.API.LMSCommit('');
                                console.log('INIT WAS INIT')
                                self.$http.post(window.API.options.INIT, {_token: '{{ csrf_token() }}'})
                                    .then(response => {
                                        window.API.Cache().setMultiple(response.body);
                                        window.API.Cache().set("cmi.core.student_name", '{{ user()->displayname }}');
                                        window.API.Cache().set("cmi.core.student_id", '{{ user()->id }}');
                                        console.log('INIT WAS INIT POST', response.body, JSON.parse(JSON.stringify(window.API.Cache().get())))
                                    });
                            });

                            window.API.on('LMSSetValue', function (varname, value, cache) {
                                window.API.Cache().set(varname, value);
                                console.log('SET WAS CALLED', varname, value)
                                // console.log('SET WAS CALLED', JSON.parse(JSON.stringify(window.API.Cache().get())))
                            });

                            window.API.on('LMSGetValue', function (varname, cache) {
                                console.log('GET WAS CALLED', varname)
                                return window.API.Cache().get(varname)
                            });

                            window.API.on('LMSCommit', function (string, cache, query) {
                                setTimeout(function () {
                                    self.$http.post(window.API.options.COMMIT, cache).then(response => {
                                        if (response.status === 200) {
                                            window.API.misc.debug(true, "[LMSCommit]", "Comitted these values: ", JSON.parse(JSON.stringify(cache)));
                                            return "true";
                                        }
                                        return response.bodyText;
                                    });
                                }, 999)
                            });

                            window.API.on('LMSFinish', function (string, cache, query) {
                                self.$http.post(window.API.options.FINISH, {_token: '{{ csrf_token() }}'}).then(response => {
                                    self.drawer.items = response.body;
                                    for (var i = self.drawer.items.length - 1; i >= 0; i--) {
                                        let current  = self.drawer.items[i];
                                        if (current.id === self.resource.id) {
                                            self.next.current = true;
                                        }
                                    }
                                });
                            });

                            window.API.on('VideoEnded', function (video, e) {
                                window.API.LMSSetValue("cmi.core.lesson_status", 'completed');
                                if (window.API.Cache().set("cmi.core.lesson_status", 'completed')) {
                                    window.API.LMSCommit('');
                                    window.API.LMSFinish('');
                                }
                            });
                            // screen.orientation && screen.orientation.lock('landscape');
                        },

                        listen () {
                        //     window.API.on('LMSFinish', function() {
                        //         // window.API.LMSGetValue("");

                        //         return "true";
                        //     });

                        //     window.API.on("LMSGetValue", function (cmiElement) {
                        //         console.info(cmiElement);
                        //         // ret =
                        //         // return ret;
                        //     });

                        //     window.API.on("LMSCommit", function () {
                        //         window.API.LMSGetValue("");
                        //         return "true";
                        //     })
                        }
                    }
                },
            },

            mounted () {
                this.lms().get();
                this.lms().mounted();
                if (this.course.started) {
                    // this.lms().listen();
                }
            },

            watch: {
                'window.API.done': function (value) {
                }

            }
        })
    </script>
@endpush
