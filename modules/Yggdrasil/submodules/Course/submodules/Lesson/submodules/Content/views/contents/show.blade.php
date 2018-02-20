@extends("Theme::layouts.public")

@section("head-title", "{$resource->course->title} &#x276f; {$resource->lesson->title} &#x276f; {$resource->title}")

@push('post-meta')
    {{-- <link rel="manifest" href="{{ url('manifest.json') }}"> --}}
@endpush

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="mb-2 elevation-1">
                    <v-toolbar card dense class="transparent">
                        <v-toolbar-title class="title">{{ $resource->title }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="goFullscreen"><v-icon>@{{ fullscreen.model ? 'fullscreen' : 'fullscreen_exit' }}</v-icon></v-btn>
                    </v-toolbar>
                    <v-alert
                        icon="check"
                        class="success ma-0"
                        dismissible
                        v-model="resource.completed"
                        transition="slide-y-transition"
                        :timeout="2000"
                        style="z-index: 2"
                    >
                        <v-card style="margin-bottom: -2rem" class="elevation-1 mb--2">
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
                                            <v-btn dark class="secondary" ripple :href="previous.url"><v-icon left>arrow_back</v-icon>{{ __('Go to Previous') }}</v-btn>
                                            <v-spacer></v-spacer>
                                        </v-card-actions>
                                        <v-spacer></v-spacer>
                                    </v-layout>
                                </v-container>
                            </v-card-media>
                        </v-card>
                        <template v-else>
                            <v-card v-if="! course.started" flat class="grey--text text--darken-1">
                                <v-container fill-height fluid>
                                    <v-layout fill-height wrap column>
                                        <v-card-text class="quill-text">
                                            {!! $resource->body !!}
                                        </v-card-text>
                                        <v-spacer></v-spacer>
                                        <v-card-actions class="pa-4">
                                            <v-spacer></v-spacer>
                                            <v-btn dark class="primary" @click="playInteraction()">
                                                <v-icon left>play_circle_outline</v-icon>
                                                <template v-if="resource.incomplete">{{ __('Continue') }}</template>
                                                <template v-else-if="resource.completed">{{ __('Play Again') }}</template>
                                                <template v-else>{{ __('Start') }}</template>
                                            </v-btn>
                                        </v-card-actions>
                                    </v-layout>
                                </v-container>
                            </v-card>
                        </template>
                        <div id="interactive-container">
                            <v-fade-transition>
                                <template v-if="course.started">
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

                    <v-divider></v-divider>

                    <v-layout row wrap justify-center align-center>
                        <v-flex md6 xs12>
                            <v-card-text>
                                <p class="body-2 grey--text page-title mb-1">PUBLISHED ON {{ $resource->created }}</p>
                                <h2 class="page-title display-1">{{ $resource->lesson->title }}:</h2>
                                <h2 class="page-title display-1 grey--text">{{ $resource->title }}</h2>
                            </v-card-text>
                        </v-flex>

                        <v-flex md6 xs12>
                            <v-card-text>
                                <p class="grey--text">{{ $resource->excerpt }}</p>
                            </v-card-text>

                            <v-card-text class="text-xs-right">
                                <v-btn success outline><v-icon success left>keyboard_arrow_left</v-icon> Previous</v-btn>
                                 <v-btn success outline> Next <v-icon success right>keyboard_arrow_right</v-icon> </v-btn>
                            </v-card-text>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-layout>

        <v-layout row wrap justify-center align-center>
            <v-flex lg10 md11 xs12>
                <v-layout row wrap>
                    <v-flex md8 xs12>
                        {{-- Comments Section --}}
                        <v-card class="elevation-1">
                            @include("Content::widgets.comments")
                        </v-card>
                        {{-- Comments Section --}}
                    </v-flex>

                    <v-flex md4 xs12>
                        <v-card class="elevation-1 mb-3">
                            <v-card-text>
                                <div class="page-title mb-1"><strong>{{ $resource->course->title }}:</strong></div>
                                <div class="page-title">{{ $resource->lesson->title }}</div>
                            </v-card-text>
                            <v-list class="mb-3">
                                <v-list-tile
                                    :href="item.url"
                                    v-for="(item, i) in drawer.items"
                                    :key="i"
                                    :class="{'white--text': (resource.id == item.id)}"
                                    ripple
                                    v-bind:ripple="{ class: 'primary--text' }">
                                    <v-list-tile-action>
                                        <v-icon left v-if="item.completed">check</v-icon>
                                        <v-icon left v-else-if="item.current">play_circle_outline</v-icon>
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
                    lesson_status_completed: false,
                }
            },
            methods: {
                playInteraction () {
                    this.goFullscreen();
                    this.course.started = !this.course.started
                },
                unloadSCO () {
                    window.API.LMSCommit("");
                    return window.API.LMSFinish("");
                },

                goFullscreen() {
                    this.fullscreen.model = !this.fullscreen.model;
                    // document.querySelector('#interactive-container')
                    // window.API.stage.fullscreen();
                    window.API.stage.fullscreen(document.querySelector('#interactive-container'));
                },


                lms () {
                    let self = this;

                    return {
                        exit () {
                            self.messagebox.btnDiabled = !self.messagebox.btnDiabled;
                            window.API.LMSFinish('');
                            // window.close();
                        },

                        get () {
                            window.API.on('BeforeInitialize', function (cache) {
                                // Start getting the initial values from the LMS.
                                // This is done in the custom (non-SCORM) function BeforeInitialize, because the request
                                // is asynchronous.
                                if (! self.resource.locked) {
                                    self.$http.post('{{ route('api.scorm.lmsinitialize', [$resource->lesson->course->id, $resource->id]) }}', {_token: '{{ csrf_token() }}'}).then(response => {
                                        window.API.Cache().setMultiple(response.body);
                                        window.API.Cache().set("cmi.core.student_name", '{{ user()->displayname }}');
                                        window.API.Cache().set("cmi.core.student_id", '{{ user()->id }}');
                                    });
                                }
                            });

                            // Initialize the API with options.
                            window.API.init('{{ $resource->version }}', {
                                _token: '{{ csrf_token() }}',
                                debug: '{{ env('APP_DEBUG') ?? 'false' }}',
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
                            });

                            window.API.on('LMSSetValue', function (varname, value, cache) {
                                // //
                            });

                            window.API.on('LMSGetValue', function (varname, cache) {
                                // console.log("CACHED-----", JSON.parse(JSON.stringify(cache)));
                            });

                            window.API.on('LMSCommit', function (string, cache, query) {
                                console.log("Commit", JSON.parse(JSON.stringify(cache)));
                                setTimeout(function () {
                                    self.$http.post(window.API.options.COMMIT, cache).then(response => {
                                        if (response.status === 200) {
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
                        //         console.log('[LMS]', "Finished")

                        //         return "true";
                        //     });

                        //     window.API.on("LMSGetValue", function (cmiElement) {
                        //         console.log('[LMS]', "GetValue")
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
                if (this.course.started) {
                    this.lms().mounted();
                    // this.lms().listen();
                }
            },

            watch: {
                'course.started': function (value) {
                    if (value) {
                        this.lms().mounted();
                        this.lms().listen();
                    }
                },
                'window.API.done': function (value) {
                    console.log('value', value);
                }

            }
        })
    </script>
@endpush
