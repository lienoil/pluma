@extends("Theme::layouts.public")

@section("content")
    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <v-toolbar dark class="mb-3 info elevation-1 sticky">
                    <v-icon dark>fa-book</v-icon>
                    <v-toolbar-title primary-title class="page-title">{{ __('All Courses') }}</v-toolbar-title>
                    <v-spacer></v-spacer>

                    <template>
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
                        <v-btn v-show="resources.searchform.model" icon v-tooltip:left="{html:'{{ __('Search') }}'}" @click.stop="resources.searchform.model = !resources.searchform.model"><v-icon>close</v-icon></v-btn>
                    </template>
                    {{-- <v-btn icon v-tooltip:left="{html:'{{ __('Sort') }}'}"><v-icon>sort</v-icon></v-btn> --}}
                    {{-- <v-btn icon v-tooltip:left="{html:bulk.gridlist.model?'{{ __('Grid View') }}':'{{ __('List View') }}'}" @click.stop="bulk.gridlist.model = !bulk.gridlist.model"><v-icon v-html="bulk.gridlist.model?'apps':'list'"></v-icon></v-btn> --}}
                    {{-- <v-btn icon v-tooltip:left="{html:'{{ __('Filter') }}'}"><v-icon>fa-filter</v-icon></v-btn> --}}
                </v-toolbar>
            </v-flex>
        </v-layout>
        <v-layout row wrap fill-height>

            <v-flex v-if="! resources.items.length" sm12 class="text-xs-center"><div class="grey--text body-1">{{ __('No Courses Found') }}</div></v-flex>
            <v-progress-circular indeterminate v-show="resources.loading" :size="50" class="primary--text"></v-progress-circular>

            {{-- START LOOP --}}
            <template v-for="(resource, i) in resources.items">
            {{-- @foreach ($resources->items() as $i => $resource) --}}
                <v-flex lg3 md4>

                    <v-card class="elevation-1" height="100%">
                        <v-layout column wrap fill-height class="ma-0">
                            {{-- Media --}}
                            <a :href="route(resources.url.public.single, resource.slug)">
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
                                                <v-card-actions>
                                                    <v-avatar tile v-if="resource.feature" size="80px">
                                                        <img :src="resource.feature" :alt="resource.title">
                                                    </v-avatar>
                                                    <v-spacer></v-spacer>
                                                    {{-- If Enrolled --}}
                                                    <v-chip v-if="resource.enrolled" class="red accent-3 white--text">
                                                        <strong>{{ __('Enrolled') }}</strong>
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
                            <v-card-actions class="grey lighten-4 transparent">
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
                            <v-card-actions>
                                <div>
                                    <v-avatar v-if="resource.user.avatar" size="25px">
                                        <img :src="resource.user.avatar" :alt="resource.user.displayname">
                                    </v-avatar>
                                    <a :href="route(resources.url.public.profile, resource.user.handlename)" class="caption grey--text td-n" v-html="resource.user.fullname"></a>
                                </div>
                                <v-spacer></v-spacer>
                                <div v-if="resource.category" class="caption pa-1 grey--text">
                                    <v-icon class="caption" left>label</v-icon>
                                    <a title="{{ __('Course category') }}" href="{{ route('courses.all', ['category_id' => v('resource.category.id')]) }}" v-html="resource.category.name"></a>
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

        </v-layout>
    </v-container>
@endsection

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
                                single: '{{ route('courses.single', 'null') }}',
                                profile: '{{ route('profile.show', 'null') }}',
                            },
                        },
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Alias") }}', align: 'left', value: 'alias' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Grants") }}', align: 'left', value: 'grants' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            descending: false,
                            page: 1,
                            sortBy: 'id',
                            rowsPerPage: '{{ settings('items_per_page', 30) }}',
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
                                this.resources.totalItems = data.items.total ? data.items.total : data.total;
                                this.resources.loading = false;
                            });
                    }, 1000);
                },
            },
            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.resources.pagination;
                    let query = {
                        descending: descending ? descending : null,
                        page: page,
                        sort: sortBy ? sortBy : null,
                        take: rowsPerPage,
                    };

                    this.api().get('{{ route('api.courses.all') }}', query)
                        .then((data) => {
                            this.resources.items = data.items.data ? data.items.data : data.items;
                            this.resources.totalItems = data.items.total ? data.items.total : data.total;
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
