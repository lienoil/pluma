@viewable('course')
    @php
        $course = \Course\Models\User::find(user()->id)->courses()->latest()->first();
        // {{ dd($course); }}
    @endphp
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            @if ($course)
                <v-parallax
                    dark
                    v-show="!removecourse"
                    transition="slide-y-transition"
                    class="elevation-1 mb-3 draggable-widget"
                    {{-- style="background: linear-gradient(45deg, #c32d60 0%, #00BCD4 100%);" --}}
                    {{-- style="background: linear-gradient(160deg, #F16623 0%, #FDDC0D 100%) !important;" --}}
                    src="{{ $course->backdrop }}"
                    height="350px"
                    >
                    <div
                        class="insert-overlay"
                        style="background: rgba(0, 0, 0, .3); position: absolute; width: 100%; height: 100%; z-index: 0;">
                    </div>

                    <v-card class="transparent" dark flat>
                        <v-card-text>

                            {{-- @foreach ($courses as $i => $course) --}}
                                <v-layout row wrap justify-center align-center>
                                    <v-flex md8 sm10 xs12>
                                        <v-layout row wrap>
                                            <v-flex xs12>
                                                <v-card-text class="text-md-left text-xs-center">
                                                    <h3 class="headline page-title"><strong>{{ $course->title }}</strong></h3>

                                                    <v-chip dark label small class="ml-0 pl-0 white--text subheading transparent elvation-0">
                                                        <v-icon left small class="subheading">class</v-icon><span>{{ $course->code }}</span></v-chip>

                                                        <v-chip dark label small class="white--text subheading transparent elevation-0"><v-icon left small class="subheading">fa-tasks</v-icon>&nbsp;<span>{{ $course->lessons->count() }} {{ $course->lessons->count() <= 1 ? __('Part') : __('Parts') }}</span></v-chip>

                                                        <v-chip dark label small class="white--text subheading transparent elevation-0"><v-icon left small class="subheading">class</v-icon><span>{{ $course->code }}</span></v-chip>

                                                        <v-chip dark label small class="white--text subheading transparent elevation-0"><v-icon left small class="subheading">fa-clock-o</v-icon><span>{{ $course->created }}</span></v-chip>

                                                        @if ($course->category)
                                                        <v-chip label class="ma-0 white--text subheading transparent elevation-0"><v-icon left small class="subheading">label</v-icon><a class="td-n white--text" target="_blank" href="{{ route('courses.all', ['category_id' => $course->category->id]) }}">{{ $course->category->name }}</a></v-chip>
                                                    @endif

                                                    <v-card-actions class="course-progress">
                                                        <v-progress-linear height="12" info v-model="courseProgress"></v-progress-linear>
                                                        <span class="px-3 primary--text"><strong>{{ $course->progress }}%</strong></span>
                                                    </v-card-actions>

                                                    @if (! $course->completed)

                                                        <div class="text-xs-center">
                                                            <v-btn class="px-3" secondary large round href="{{ $course->latest->url }}">Continue</v-btn>
                                                        </div>
                                                    @else
                                                        {{ __('') }}
                                                    @endif
                                                </v-card-text>
                                            </v-flex>
                                        </v-layout>
                                    </v-flex>
                                </v-layout>
                                {{-- @endforeach --}}
                            </v-card-text>
                        </v-card>
                    </v-parallax>

            @else
                <v-card-media
                    v-show="!removecourse"
                    trasition="slide-y-transition"
                    class="elevation-1 mb-3 draggable-widget"
                    {{-- style="background: linear-gradient(45deg, #c32d60 0%, #00BCD4 100%);" --}}
                    style="background: linear-gradient(160deg, #F16623 0%, #FDDC0D 100%) !important;">
                    <div
                        class="insert-overlay"
                        style="background: rgba(0, 0, 0, 0.1);
                        position: absolute;
                        width: 100%;
                        height: 100%; z-index: 0;">
                    </div>

                    <v-card dark class="transparent" flat>
                        <v-card-text>
                            <v-layout row wrap justify-center align-center>
                                <v-flex md8 sm10 xs12>
                                    <v-layout row wrap>
                                        <v-flex md4 xs12>
                                            <v-card-text class="text-xs-center">
                                                <v-avatar size="180px" class="elevation-1">
                                                    <img src="{{ assets('frontier/images/placeholder/section-2.png') }}" alt="">
                                                </v-avatar>
                                            </v-card-text>
                                        </v-flex>

                                        <v-flex md8 xs12>
                                            <v-card-text class="text-md-left text-xs-center">
                                                <h3 class="headline page-title"><strong>Get Course Blah</strong></h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est ratione totam deleniti libero adipisci aperiam vero dolores facilis accusamus impedit ipsum provident ad quasi ipsa, distinctio magnam expedita, inventore, mollitia.</p>
                                                <div class="text-xs-center">
                                                    <v-btn class="px-3" secondary large round href="{{ route('courses.all') }}">Enroll Course Now</v-btn>
                                                </div>
                                            </v-card-text>
                                        </v-flex>
                                    </v-layout>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                    </v-card>
                </v-card-media>
            @endif
        </v-slide-y-transition>
    </draggable>

    @push('css')
        <style>
            .draggable-widget .parallax__content {
                padding-left: 0px !important;
                padding-right: 0
            }

            .course-progress .progress-linear--info .progress-linear__bar {
                background: #fdbe3c45 !important;
            }

            .course-progress .progress-linear--info .progress-linear__bar__determinate, .progress-linear--info .progress-linear__bar__indeterminate .long, .progress-linear--info .progress-linear__bar__indeterminate .short {
                    background: #fdbe3c !important;
            }

            .course-progress .progress-linear {
                box-shadow: 0 2px 4px -1px rgba(0,0,0,.2),0 4px 5px rgba(0,0,0,.14),0 1px 10px rgba(0,0,0,.12) !important;
            }

            .text-ellipsis {
                display: -webkit-box;
                max-width: 400px;
                line-height: 1.4;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
    @endpush

    @push('pre-scripts')
        <script>
            mixins.push({
                data () {
                    return {
                        removecourse: this.getStorage('widgets.removecourse') === "true",
                        hidecourse: this.getStorage('widgets.hidecourse') === "true",
                        courseProgress: '{{ $course->progress ?? 0 }}',
                    }
                }
            });
        </script>
    @endpush
@endviewable
