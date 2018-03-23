@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="mb-2 secondary elevation-1 sticky">
        <v-icon dark>fa-book</v-icon>

        <v-toolbar-title primary-title class="page-title">
            @if (request()->all())
                {{ __('My Filtered Courses') }}
            @else
                {{ __('My Courses') }}
            @endif
        </v-toolbar-title>

        <v-spacer></v-spacer>

        <template v-if="!resources.searchform.model && !resources.pagination.sortByModel">
            {{-- Rows Per Page --}}
            <v-menu>
                <div class="theme--dark pa-2" slot="activator">
                    {{-- <v-icon dark>sort</v-icon> --}}
                    <span v-html="resources.pagination.rowsPerPageDisplayName"></span>
                    <v-icon dark right>arrow_drop_down</v-icon>
                </div>
                <v-list>
                    <v-list-tile ripple @click="resources.pagination.rowsPerPage = (n.value ? n.value : n);resources.pagination.rowsPerPageDisplayName=(n.text ? n.text : n)" :key="i" v-for="(n, i) in resources.pagination.rowsPerPageItems">
                        <v-list-tile-title v-html="n.text ? n.text : n"></v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            {{-- Rows Per Page --}}
        </template>

        {{-- Sort --}}
        {{-- <template v-if="!resources.searchform.model">
            <template v-if="resources.pagination.sortByModel">
                <v-btn primary class="elevation-1" v-for="(n, i) in resources.headers"><span v-html="n.text"></span></v-btn>
            </template>

            <v-btn v-show="!resources.pagination.sortByModel" icon v-tooltip:left="{html:'{{ __('Sort') }}'}" @click.stop="resources.pagination.sortByModel = !resources.pagination.sortByModel"><v-icon>sort</v-icon></v-btn>
            <v-btn v-show="resources.pagination.sortByModel" ripple icon v-tooltip:left="{html:'{{ __('Sort') }}'}" @click="resources.pagination.sortByModel=!resources.pagination.sortByModel;"><v-icon>close</v-icon></v-btn>
        </template> --}}
        {{-- Sort --}}

        <template v-if="!resources.pagination.sortByModel">
            <v-text-field
                :prefix="resources.searchform.prefix"
                :prepend-icon="resources.searchform.prepend"
                append-icon="search"
                light solo hide-details single-line
                placeholder="{{ __('Search All Courses') }}"
                v-model="resources.searchform.query"
                v-show="resources.searchform.model"
            ></v-text-field>
            <v-btn v-show="!resources.searchform.model" icon v-tooltip:left="{html:'{{ __('Search') }}'}" @click.stop="resources.searchform.model = !resources.searchform.model"><v-icon>search</v-icon></v-btn>
            <v-btn v-show="resources.searchform.model" ripple icon v-tooltip:left="{html:'{{ __('Search') }}'}" @click="resources.searchform.model=!resources.searchform.model;resources.searchform.query=''"><v-icon>close</v-icon></v-btn>
        </template>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap fill-height>

            <v-flex v-if="! resources.items.length && ! resources.loading" sm12 class="text-xs-center">
                <v-icon class="grey--text display-4">fa-book</v-icon>
                <div class="grey--text headline">{{ __('No Courses Found') }}</div>
            </v-flex>

            <v-flex v-if="resources.loading" sm12 class="text-xs-center">
                <v-progress-circular indeterminate v-show="resources.loading" :size="50" class="primary--text"></v-progress-circular>
            </v-flex>

            {{-- START LOOP --}}
            <template v-for="(resource, i) in resources.items">
            {{-- @foreach ($resources->items() as $i => $resource) --}}
                <v-flex lg3 md4>

                    <v-card class="elevation-1 c-lift" height="100%">
                        <v-layout column wrap fill-height class="ma-0">
                            {{-- Media --}}
                            <a class="td-n" :href="route(resources.url.public.single, resource.slug)">
                                <v-card-media class="accent lighten-3" :src="resource.backdrop" height="220px">
                                    <v-container fill-height fluid class="white--text py-0">
                                        <v-layout fill-height column wrap>
                                            <v-card flat class="transparent">
                                                <v-toolbar card class="transparent">
                                                    {{-- If Bookmarked --}}
                                                    {{-- <v-btn v-if="resource.bookmarked" icon class="red darken-1" v-tooltip:right="{html:'{{ __('Remove from Bookmarked') }}'}" @click="post(route(resources.urls.api.unbookmark, (resource.id)), {_token: '{{ csrf_token() }}'})"><v-icon small class="white--text">fa-bookmark</v-icon></v-btn> --}}
                                                    {{-- /If Bookmarked --}}
                                                    <v-spacer></v-spacer>
                                                </v-toolbar>
                                            </v-card>
                                            <v-spacer></v-spacer>
                                            <v-card flat class="transparent">
                                                <v-card-actions class="py-3">
                                                    <v-avatar class="elevation-4" v-if="resource.feature" size="80px">
                                                        <img :src="resource.feature" :alt="resource.title">
                                                    </v-avatar>
                                                    <v-spacer></v-spacer>
                                                    {{-- If Enrolled --}}
                                                    <v-chip v-if="resource.enrolled" small class="ml-0 green td-n white--text">{{ __('Enrolled') }}
                                                    </v-chip>
                                                    {{-- /If Enrolled --}}
                                                </v-card-actions>
                                            </v-card>
                                        </v-layout>
                                    </v-container>
                                </v-card-media>
                            </a>

                            {{-- Title --}}
                            <v-card-title>
                                <a :href="route(resources.url.public.single, resource.slug)" class="accent--text td-n" v-html="resource.title"></a>
                            </v-card-title>

                            {{-- Meta --}}
                            <v-card-actions class="grey lighten-4">

                                <div v-if="resource.code" class="text-xs-center caption pa-1 grey--text" title="{{ __('Course code') }}">
                                    <v-icon class="caption" left>class</v-icon>
                                    <span v-html="resource.code"></span>
                                </div>

                                <div v-if="resource.lessons" class="text-xs-center caption pa-1 grey--text" title="{{ __('Number of parts') }}">
                                    <v-icon class="caption" left>fa-tasks</v-icon>
                                    <span v-html="`${resource.lessons.length} ${resource.lessons.length <= 1 ? '{{ __('Part') }}' : '{{ __('Parts') }}'}`"></span>
                                </div>

                                <div v-if="resource.created" class="text-xs-center caption pa-1 grey--text" title="{{ __('Published date') }}">
                                    <v-icon class="caption" left>fa-clock-o</v-icon>
                                    <span v-html="resource.created"></span>
                                </div>
                            </v-card-actions>

                            {{-- Excerpt --}}
                            <v-card-text class="grey--text text--darken-1 body-1" v-html="resource.excerpt"></v-card-text>
                            {{-- <v-card-title primary-title class="page-title subheading">
                                <a :href="route(resources.url.public.single, resource.slug)" class="accent--text td-n" v-html="resource.title"></a>
                            </v-card-title> --}}

                            <v-spacer></v-spacer>

                            {{-- Author --}}
                            <v-card-actions class="pa-3">
                                <div>
                                    <v-avatar v-if="resource.user.avatar" size="25px">
                                        <img :src="resource.user.avatar" :alt="resource.user.displayname">
                                    </v-avatar>
                                    <a :href="route(resources.url.public.profile, resource.user.handlename)" class="caption grey--text td-n" v-html="resource.user.fullname"></a>
                                </div>
                                <v-spacer></v-spacer>
                                <div v-if="resource.category" class="caption pa-1 grey--text">
                                    <v-icon class="body-1" left v-html="resource.category.icon"></v-icon>
                                    <a class="td-n accent--text" title="{{ __('Course category') }}" :href="route(resources.url.public.all,`category_id=${resource.category.id}`)" v-html="resource.category.name"></a>
                                </div>
                            </v-card-actions>

                            {{-- Call to Actions --}}
                            {{-- <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn v-if="resource.enrolled" flat primary ripple href="{{ route('courses.enrolled.show', 'null') }}">{{ __('Continue') }}</v-btn>
                                <v-btn v-else flat primary ripple :href="`{{ route('courses.single', 'null') }}`">{{ __('Learn More') }}</v-btn>
                            </v-card-actions> --}}

                        </v-layout>
                    </v-card>

                </v-flex>
            {{-- @endforeach --}}
            </template>
            {{-- END LOOP --}}

            @if (request()->all())
                <v-flex sm12>
                    <v-btn flat warning href="{{ route('courses.all') }}"><v-icon left>remove_circle</v-icon><span>{{ __('Remove Filters') }}</span></v-btn>
                </v-flex>
            @endif

            <v-flex sm12 class="text-xs-center" v-if="resources.pagination.totalItems">
                <v-pagination class="elevation-0" :length="resources.pagination.last_page" v-model="resources.pagination.page" circle></v-pagination>
            </v-flex>
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

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>

    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        destroy: {
                            model: false,
                        },
                        gridlist: {
                            model: true,
                        },
                    },
                    resources: {
                        url: {
                            admin: {
                                show: '{{ route('courses.show', 'null') }}',
                                edit: '{{ route('courses.edit', 'null') }}',
                                enrolled: '{{ route('courses.enrolled.show', 'null') }}',
                            },
                            api: {
                                bookmark: '{{ route('api.courses.bookmark.bookmark', 'null') }}',
                                destroy: '{{ route('api.courses.destroy', 'null') }}',
                                unbookmark: '{{ route('api.courses.bookmark.unbookmark', 'null') }}',
                            },
                            public: {
                                all: '{{ route('courses.all', 'null') }}',
                                single: '{{ route('courses.single', 'null') }}',
                                profile: '{{ route('profile.show', 'null') }}',
                            },
                        },
                        headers: [
                            { text: '{{ __("Course Title") }}', align: 'left', value: 'title' },
                            { text: '{{ __("Course Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Latest Courses") }}', align: 'left', value: 'created_at', descending: true },
                            { text: '{{ __("Category") }}', align: 'left', value: 'category_id', descending: true },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            descending: false,
                            page: 1,
                            sortByDisplayName: '{{ __('Course Title') }}',
                            sortBy: 'title',
                            sortByModel: false,
                            rowsPerPageItems: [5, 10, 15, 20, 30, {'value':50,text:50}, {'value':'-1',text:'All'}],
                            rowsPerPageDisplayName: {{ settings('items_per_page', 30) }},
                            rowsPerPage: {{ settings('items_per_page', 30) }},
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                }
            },
            watch: {
                'resources.searchform.query': function (filter) {
                    this.resources.loading = true;
                    this.resources.items = [];
                    setTimeout(() => {
                        const { sortBy, descending, page, rowsPerPage } = this.resources.pagination;
                        let query = {
                            descending: descending,
                            page: page,
                            search: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.courses.search') }}', query)
                            .then((data) => {
                                this.resources.items = data.items.data ? data.items.data : data.items;
                                this.resources.pagination.totalItems = data.items.total ? data.items.total : data.total;
                                this.resources.loading = false;
                            });
                    }, 900);
                },
                'resources.pagination.page': function (page) {
                    this.get();
                },
                'resources.pagination.rowsPerPage': function (val) {
                    this.get();
                },
                'resources.pagination.sortBy': function (val) {
                    this.get();
                }
            },
            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.resources.pagination;
                    let query = {
                        descending: descending ? descending : false,
                        page: page,
                        sort: sortBy ? sortBy : null,
                        take: rowsPerPage,
                        search: {!! @json_encode(request()->all()) !!},
                    };

                    this.api().get('{{ route('courses.my') }}', query)
                        .then((data) => {
                            // console.log(data);
                            this.resources.items = data.items.data ? data.items.data : data.items;
                            this.resources.pagination.totalItems = data.items.total ? data.items.total : data.total;
                            this.resources.pagination.last_page = data.items.last_page;
                            this.resources.loading = false;
                        });
                },

                post (url, query) {
                    this.api().post(url, query).then(response => {
                        this.get();
                    });
                },

                destroy (url, query) {
                    this.api().delete(url, query).then(response => {
                        this.get();
                    });
                }
            },

            mounted () {
                this.get();
            },
        })
    </script>
@endpush
