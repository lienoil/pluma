@extends("Theme::layouts.public")

<<<<<<< HEAD
@section("head-title", "{$resource->course->title} - {$resource->lesson->title} - {$resource->title}")

@push('post-meta')
    <link rel="manifest" href="{{ assets('yggdrasil/manifest.json') }}">
@endpush

@section("content")
    <v-navigation-drawer
        temporary
        v-model="drawer.model"
        light
        fixed
    >
        <v-list class="pa-1">
            <v-list-tile avatar>
                <v-list-tile-content>
                    <v-list-tile-title><strong>{{ $resource->lesson->title }}</strong></v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
        <v-divider></v-divider>
        <v-list>
            <v-list-tile :href="item.url" v-for="(item, i) in drawer.items" :key="i" ripple :class="{'primary white--text': (resource.id == item.id)}">
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
    </v-navigation-drawer>
    <v-toolbar dark extended class="text-xs-center secondary elevation-0">
        <v-layout wrap justify-space-around align-center hidden-xs-only>
            <template v-if="previous">
                <v-btn
                    v-if="previous"
                    :href="previous.url"
                    ripple
                    flat
                >
                    <v-icon left dark v-if="previous.completed">check</v-icon>
                    <v-icon left dark v-else-if="previous.locked">lock</v-icon>
                    <v-icon left dark v-else-if="previous.current">play_circle_outline</v-icon>
                    <v-icon left dark v-else>arrow_back</v-icon>
                    <span v-html="previous.title"></span>
                </v-btn>
            </template>
            <v-btn v-else disabled flat><span v-html="resource.lesson.title"></span></v-btn>

            <span class="caption">{{ "$resource->order/{$resource->lesson->contents->count()}" }}</span>

            <template v-if="next">
                <v-btn
                    v-if="next"
                    :href="next.url"
                    ripple
                    flat
                >
                    <span v-html="next.title"></span>
                    <v-icon right dark v-if="next.completed">check</v-icon>
                    <v-icon right dark v-else-if="next.locked">lock</v-icon>
                    <v-icon right dark v-else-if="next.current">play_circle_outline</v-icon>
                    <v-icon right dark v-else>arrow_forward</v-icon>
                </v-btn>
            </template>
            <v-btn v-else disabled flat>{{ __('End of Lesson') }}</v-btn>
        </v-layout>
    </v-toolbar>
    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-btn style="z-index: 2" fab bottom left primary dark medium fixed v-tooltip:right="{html: 'Table of Contents'}" @click.stop="drawer.model = !drawer.model"><v-icon>menu</v-icon></v-btn>
                <v-card class="card--flex-toolbar card--filed-on-top" style="overflow: hidden">
=======
@section("head-title", "{$resource->course->title} &#x276f; {$resource->lesson->title} &#x276f; {$resource->title}")

@push('post-meta')
    {{-- <link rel="manifest" href="{{ url('manifest.json') }}"> --}}
@endpush

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="mb-2 elevation-1">
>>>>>>> dev
                    <v-toolbar card dense class="transparent">
                        <v-toolbar-title class="title">{{ $resource->title }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn icon @click="goFullscreen"><v-icon>@{{ fullscreen.model ? 'fullscreen' : 'fullscreen_exit' }}</v-icon></v-btn>
<<<<<<< HEAD
                        {{-- <v-dialog max-width="90vw" width="80vw">
                            <v-btn slot="activator" icon v-tooltip:left="{html: 'Close this window'}"><v-icon>close</v-icon></v-btn>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ __("Close this window?") }}</span>
                                </v-card-title>
                                <v-card-text>
                                    <p>{!! __("You are about to close this entire window. The LMS will try and save you're progress but it is <strong>not guaranteed</strong>.") !!}</p>
                                    <p>{{ __("Do you want to proceed? Click anywhere to cancel.") }}</p>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn primary class="elevation-1" @click="lms().exit()">Try Save &amp; Exit</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog> --}}
                    </v-toolbar>
=======
                    </v-toolbar>

>>>>>>> dev
                    <v-alert
                        icon="check"
                        class="success ma-0"
                        dismissible
                        v-model="resource.completed"
                        transition="slide-y-transition"
                        :timeout="2000"
                        style="z-index: 2"
<<<<<<< HEAD
                    >
                        <v-card style="margin-bottom: -2rem" class="elevation-1 mb--2">
=======
                        >
                        <v-card style="margin-bottom: -2rem" class="elevation-1 mb-2">
>>>>>>> dev
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
<<<<<<< HEAD
                                {{-- <v-card-media height="480px"> --}}
                                    <v-container fill-height fluid>
                                        <v-layout fill-height wrap column>
                                            <v-card-text class="quill-text">
                                                {!! $resource->body !!}
                                            </v-card-text>
                                            <v-spacer></v-spacer>
                                            <v-card-actions>
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
                                {{-- </v-card-media> --}}
=======
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
>>>>>>> dev
                            </v-card>
                        </template>
                        <div id="interactive-container">
                            <v-fade-transition>
                                <template v-if="course.started">
<<<<<<< HEAD
                                    <div class="course-interactive-container">
                                        {!! $resource->html !!}

=======
                                    <div>
                                        {!! $resource->html !!}
>>>>>>> dev
                                        <v-dialog v-model="messagebox.model" width="60vw" persistent>
                                            <v-card flat tile class="text-xs-center">
                                                <v-icon class="display-4 success--text">check</v-icon>
                                                <v-card-text class="headline success--text text-xs-center">{{ __("Completed") }}</v-card-text>
                                                <v-card-text class="grey--text text--darken-1">
                                                    {{ __("You have finished this Interaction. Click below to continue.") }}
                                                </v-card-text>
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
<<<<<<< HEAD
                                                    <v-btn :disabled="messagebox.btnDisabled" primary @click="messagebox.model = !messagebox.model">{{ __("Okay") }}</v-btn>
=======
                                                    <v-btn :disabled="messagebox.btnDiabled" primary @click="messagebox.model = !messagebox.model">{{ __("Okay") }}</v-btn>
>>>>>>> dev
                                                    <v-spacer></v-spacer>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                    </div>
                                </template>
                            </v-fade-transition>
                        </div>
                    </template>

<<<<<<< HEAD
                </v-card>
            </v-flex>
        </v-layout>
=======
                    <v-divider></v-divider>

                    <v-layout row wrap justify-center align-center>
                        <v-flex md6 xs12>
                            <v-card-text>
                                <p class="body-2 grey--text page-title mb-1">PUBLISHED ON {{ $resource->created }}</p>
                                <p class="subheading grey--text text--darken-1 page-title mb-1"><strong>{{ $resource->course->title }}</strong></p>
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
                            <v-toolbar flat class="transparent">
                                <v-toolbar-title class="page-title">{{ $resource->lesson->title }}</v-toolbar-title>
                            </v-toolbar>
                            <v-divider></v-divider>
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
>>>>>>> dev
    </v-container>
@endsection

@section("back-to-top", "")

@push('css')
    <style>
<<<<<<< HEAD
        .course-interactive-container {
            /**/
        }
=======
>>>>>>> dev
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
<<<<<<< HEAD
            /*max-height: 100vh;*/
=======
            max-height: 100vh;
>>>>>>> dev
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
<<<<<<< HEAD
                        btnDisabled: false,
=======
                        btnDiabled: false,
>>>>>>> dev
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
<<<<<<< HEAD
                    // this.goFullscreen();
=======
                    this.goFullscreen();
>>>>>>> dev
                    this.course.started = !this.course.started
                },
                unloadSCO () {
                    window.API.LMSCommit("");
                    return window.API.LMSFinish("");
                },

                goFullscreen() {
<<<<<<< HEAD
                    window.API.stage.fullscreen(document.querySelector('#interactive-container'));
                    this.fullscreen.model = !this.fullscreen.model;
                },

=======
                    this.fullscreen.model = !this.fullscreen.model;
                    // document.querySelector('#interactive-container')
                    // window.API.stage.fullscreen();
                    window.API.stage.fullscreen(document.querySelector('#interactive-container'));
                },


>>>>>>> dev
                lms () {
                    let self = this;

                    return {
                        exit () {
<<<<<<< HEAD
                            self.messagebox.btnDisabled = !self.messagebox.btnDisabled;
=======
                            self.messagebox.btnDiabled = !self.messagebox.btnDiabled;
>>>>>>> dev
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
