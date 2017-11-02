@extends("Theme::layouts.course")

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
                    <v-icon v-if="item.completed">check</v-icon>
                    <v-icon v-else-if="item.current">play</v-icon>
                    <v-icon v-else-if="item.locked">lock</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title v-html="item.title"></v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>
    <v-toolbar dark extended class="text-xs-center indigo elevation-0">
        <v-layout wrap justify-space-around align-center hidden-xs-only>
            @if ($resource->previous)
                <v-btn
                    href="{{ $resource->previous->url }}"
                    ripple
                    flat
                >
                    <v-icon left dark>arrow_back</v-icon>
                    {{ $resource->previous ? $resource->previous->title : '' }}
                </v-btn>
            @else
                <v-btn disabled flat>
                    {{ __('Start of Lesson') }}
                </v-btn>
            @endif
            <span class="caption">{{ "$resource->order/{$resource->lesson->contents->count()}" }}</span>
            @if ($resource->next)
                <v-btn
                    href="{{ $resource->next->url }}"
                    ripple
                    flat
                >
                    {{ $resource->next ? $resource->next->title : '' }}
                    <v-icon right dark>arrow_forward</v-icon>
                </v-btn>
            @else
                <v-btn disabled flat>
                    {{ __('End of Lesson') }}
                </v-btn>
            @endif
        </v-layout>
    </v-toolbar>
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-btn style="z-index: 2" fab bottom left primary dark medium fixed v-tooltip:right="{html: 'Table of Contents'}" @click.stop="drawer.model = !drawer.model"><v-icon>menu</v-icon></v-btn>
                <v-card class="card--flex-toolbar card--filed-on-top">
                    <v-toolbar card prominent class="transparent">
                        <v-toolbar-title class="title">{{ $resource->title }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-dialog width="600px">
                            <v-btn icon slot="activator" v-tooltip:left="{html: 'Show Description'}">
                                <v-icon>info</v-icon>
                            </v-btn>
                            <v-card>
                                <v-card-title>
                                    <span class="headline">{{ $resource->title }}</span>
                                </v-card-title>
                                <v-card-text>
                                    {!! $resource->description ? $resource->description : __('No description available') !!}
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    {{-- <v-btn class="green--text lighten-2" flat="flat" @click="start = false">Got it</v-btn> --}}
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-toolbar>
                    <v-card-text>
                        <div class="grey--text text--darken-2">{!! $resource->body !!}</div>
                        <v-btn @click="next">Next</v-btn>

                        <template v-if="!resource.lesson.course.enrolled">
                            <div class="text-xs-center">
                                <img src="{{ assets('course/images/no-courses.png') }}" alt="{{ __('Not enrolled') }}">
                            </div>
                            <v-card-media height="auto">
                                <v-container fill-height class="pa-0 pb-4">
                                        <v-layout fill-height wrap column>
                                            <v-spacer></v-spacer>
                                            <div class="subheading text-xs-center grey--text">
                                                {{-- <div><v-icon class="display-4 grey--text pa-5">lock</v-icon></div> --}}
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
                                </v-card-media>
                            </v-card-media>
                        </template>
                        <template v-else>
                            <v-card v-if="! resource.started" flat class="grey lighten-4 grey--text text-xs-center">
                                <v-card-media height="480px">
                                    <v-container fill-height class="pa-0">
                                        <v-layout fill-height wrap column>
                                            <v-spacer></v-spacer>
                                            <p>{{ __('You are about to start this lesson. Click below to continue. Good luck!') }}</p>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn dark class="indigo" @click="resource.started = !resource.started">{{ __('Start') }}</v-btn>
                                                <v-spacer></v-spacer>
                                            </v-card-actions>
                                            <v-spacer></v-spacer>
                                        </v-layout>
                                    </v-container>
                                </v-card-media>
                            </v-card>
                            <v-fade-transition>
                                <template v-if="resource.started">
                                    {{-- {!! $resource->html !!} --}}
                                    <div>
                                        <object width="100%" height="640px" data="{{ $resource->interactive }}">
                                            <embed src="{{ $resource->interactive }}">
                                        </object>
                                    </div>
                                </template>
                            </v-fade-transition>
                            {{-- <iframe width="100%" height="450px" src="{{ $resource->interactive }}" frameborder="0"></iframe> --}}
                        </template>

                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@section("back-to-top", "")

@push('css')
    <style>
        .interactive-content {
            width: 100%;
            max-height: 100vh;
            min-height: 240px;
            display: block;
            text-align: center;
            margin: 0 auto;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    {{-- <script src="{{ assets('course/scorm/scormdriver.js') }}"></script> --}}
    {{-- <script src="{{ assets('course/scorm/scorm.6.0.0.js') }}"></script> --}}
    {{-- <script src="{{ assets('course/scorm/scorm.js') }}"></script> --}}
    <script src="{{ assets('course/scorm/scormapi.js') }}"></script>
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
                    resource: {!! json_encode($resource) !!},
                    scorm: null,
                }
            },
            methods: {
                next() {
                    // this.scorm.init();
                    // alert(this.scorm.get("cmi.core.lesson_location"));
                    // this.scorm.save();
                    // this.scorm.quit();
                    // pipwerks.SCORM.set("cmi.core.lesson_location", 'a001_quiz_q3.html')
                    window.API.LMSSetValue("cmi.core.lesson_location", 'a001_quiz_q3.html');
                },

                lms () {
                    let self = this

                    return {
                        mountedXX () {
                            window.API.on("LMSGetValue", function (varname) {
                                self.$http.get('{{ route('api.scorm.lmsgetvalue', [$resource->lesson->course->id, $resource->id]) }}'+'?varname='+varname+'&_token='+'{{ csrf_token() }}').then(response => {
                                    console.log(response);
                                    return response.bodyText;
                                });
                            })

                            window.API.on("LMSSetValue", function (varname, value) {
                                self.$http.post('{{ route('api.scorm.lmssetvalue', [$resource->lesson->course->id, $resource->id]) }}', {varname: varname, _token: '{{ csrf_token() }}'});
                            })
                        },
                        mounted () {
                            window.API.setOptions({
                                GET: '{{ route('api.scorm.lmsgetvalue', [$resource->lesson->course->id, $resource->id]) }}',
                                POST: '{{ route('api.scorm.lmssetvalue', [$resource->lesson->course->id, $resource->id]) }}',
                                _token: '{{ csrf_token() }}',
                                done: false,
                            })
                            // screen.orientation && screen.orientation.lock('landscape');

                            // alert();
                            // self.scorm.init('');
                            // window.API.LMSInitialize("");
                            // pipwerks.SCORM.init('');

                            // window.API.on('LMSInitialize', function() {
                                // alert("Us");
                                // if(self.scorm.init()) {
                                    // alert("yeah")
                                // }
                            // });
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
                if (this.resource.started) {
                    this.lms().mounted();
                    // this.lms().listen();
                }
            },

            watch: {
                'resource.started': function (value) {
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
