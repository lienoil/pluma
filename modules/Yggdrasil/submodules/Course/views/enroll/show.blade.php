@extends("Theme::layouts.admin")

@section("head-title", $resource->title)
@section("utilitybar", '')

@section("content")
    <v-parallax class="elevation-1" :src="resource.backdrop" height="auto">
        <v-layout row wrap align-end justify-center>
            <v-flex md8 xs12 pa-0>
                <v-card tile flat class="mt-5" height="100%">
                    <v-toolbar dense card class="white">
                        <v-spacer></v-spacer>
                        <v-chip v-if="resource.enrolled" small class="ml-0 green white--text">{{ __('Enrolled') }}</v-chip>

                        <form v-if="resource.bookmarked" action="{{ route('courses.bookmark.unbookmark', $resource->id) }}" method="POST">
                            {{ csrf_field() }}
                            <v-btn type="submit" icon ripple v-tooltip:left="{ html: 'Remove from your Bookmarks' }">
                                <v-icon light class="red--text">bookmark</v-icon>
                            </v-btn>
                        </form>

                        <v-menu full-width>
                            <v-btn slot="activator" icon><v-icon>more_vert</v-icon></v-btn>
                            <v-list>
                                @can('bookmark-course')
                                <v-list-tile avatar v-if="!resource.bookmarked" ripple @click="post(route(urls.courses.bookmark, resource.id), {_token: '{{ csrf_token() }}'})">
                                    <v-list-tile-avatar>
                                        <v-icon class="red--text">bookmark_outline</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-title>{{ __('Bookmark this Course') }}</v-list-tile-title>
                                </v-list-tile>
                                <v-list-tile avatar v-else ripple @click="post(route(urls.courses.unbookmark, resource.id), {_token: '{{ csrf_token() }}'})">
                                    <v-list-tile-avatar>
                                        <v-icon class="red--text">bookmark</v-icon>
                                    </v-list-tile-avatar>
                                    <v-list-tile-title>{{ __('Remove from your Bookmarks') }}</v-list-tile-title>
                                </v-list-tile>
                                @endcan
                            </v-list>
                            @can('edit-course')
                            @endcan
                        </v-menu>
                    </v-toolbar>
                    <v-card-text>
                        <v-container fluid grid-list-lg>
                            <v-flex sm12>
                                <v-layout row wrap>
                                    <v-flex md3 sm2>
                                        <img :src="resource.feature" width="100%" height="auto">
                                        {{-- <v-card-media ripple :src="resource.feature" height="150px" cover class="elevation-1"></v-card-media> --}}
                                    </v-flex>
                                    <v-flex md9 sm10>
                                        <v-card-title primary-title class="pa-0">
                                            <strong class="headline accent--text" v-html="resource.title"></strong>
                                        </v-card-title>

                                        <v-avatar size="30px">
                                            <img :src="resource.author.avatar" :alt="resource.author.fullname">
                                        </v-avatar>
                                        <v-chip label small class="pl-0 caption transparent grey--text elevation-0">
                                            <a :href="route(urls.profile.show, resource.author.handlename)" v-html="resource.author.displayname"></a>
                                        </v-chip>

                                        <v-footer class="transparent">
                                            <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">fa-tasks</v-icon>&nbsp;<span v-html="`${resource.lessons.length} ${resource.lessons.length>1?'{{ __('Parts') }}':'{{ __('Part') }}'}`"></span></v-chip>

                                            <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">class</v-icon><span v-html="resource.code"></span></v-chip>

                                            <v-chip v-if="resource.category" label class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">label</v-icon><span v-html="resource.category.name"></span></v-chip>

                                            <v-chip label small class="pl-0 ml-0 caption transparent grey--text elevation-0"><v-icon left small class="subheading">fa-clock-o</v-icon><span v-html="resource.created"></span></v-chip>
                                        </v-footer>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                        </v-container>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-parallax>
    <v-container fluid grid-list-lg>
        @if (! $resource->enrolled)
        <v-layout row wrap>
            {{-- <v-flex flex md3 xs12 order-lg1>
                <v-card class="mb-3 elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="accent--text">{{ __('Overview') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text class="grey--text text--darken-2" v-html="resource.body"></v-card-text>
                </v-card>

            </v-flex> --}}
            <v-flex flex md3 offset-md4>
                <v-card class="elevation-1">
                    <v-card-actions>
                        <v-spacer></v-spacer>
                            <form action="{{ route('courses.enroll', [$resource->id, user()->id]) }}" method="POST">
                                {{ csrf_field() }}
                                <v-btn type="submit" class="elevation-1">{{ __('Enroll') }}</v-btn>
                            </form>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
        @endif
    </v-container>
@endsection

@push('css')
    <style>
        .media-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.30);
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {!! json_encode($resource) !!},
                    lessons: {!! json_encode($resource->lessons) !!},
                    urls: {
                        courses: {
                            unbookmark: '{{ route('api.courses.bookmark.unbookmark', 'null') }}',
                            bookmark: '{{ route('api.courses.bookmark.bookmark', 'null') }}',
                        },
                        profile: {
                            show: '{{ route('profile.show', 'null') }}'
                        }
                    },
                    {{-- resource: {!! json_encode($resource->with(['lessons', 'lessons.contents'])->first()->toArray()) !!} --}}
                }
            },

            methods: {
                closeDialog (ref) {
                    this.$refs[ref].$el.click();
                },

                get () {
                    // this.api().post('')
                },

                post (url, query) {
                    let self = this;
                    this.api().post(url, query).then(response => {
                        self.resource.bookmarked = !self.resource.bookmarked;
                    });
                },
                openWindow (url) {
                    window.open(url, 'newwindow', 'width=1028,height=730');
                }
            },

            mounted () {
                //
            }
        });
    </script>
@endpush
