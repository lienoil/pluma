@extends("Theme::layouts.admin")

@section("head-title", __('Forums'))

@section("content")
    @include("Theme::partials.banner")
    <v-toolbar dark class="light-blue elevation-1 sticky">
        <v-toolbar-title dark>{{ __('All Threads') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        {{-- Search --}}
        <template>
            <v-text-field
                :append-icon-cb="() => {dataset.searchform.model = !dataset.searchform.model}"
                :prefix="dataset.searchform.prefix"
                :prepend-icon="dataset.searchform.prepend"
                append-icon="close"
                light solo hide-details single-line
                autofocus="autofocus"
                label="Search"
                v-model="dataset.searchform.query"
                v-show="dataset.searchform.model"
                ></v-text-field>
                <v-btn v-show="!dataset.searchform.model" icon v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" @click.native="dataset.searchform.model = !dataset.searchform.model;dataset,searchform.query = '';"><v-icon>search</v-icon></v-btn>
        </template>
        {{-- /Search --}}

        {{-- <v-btn icon href="{{ route('forums.create') }}" v-tooltip:left="{ 'html': 'Create Forum' }">
            <v-icon>add</v-icon>
        </v-btn> --}}

        {{-- Sort --}}
        {{-- <v-menu transition="slide-y-transition">
            <v-btn icon v-tooltip:left="{ html: 'Sort' }" slot="activator"><v-icon>sort</v-icon></v-btn>
            <v-list>
                <v-list-tile v-for="n in 5" :key="n">
                    <v-list-tile-title v-text="'Sort ' + n"></v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-menu> --}}
        {{-- /Sort --}}

        {{-- <v-btn icon v-tooltip:left="{ html: 'Toggle the bulk command checkboxes' }"><v-icon>check_circle</v-icon></v-btn> --}}
        @can('trashed-forum')
            <v-btn icon v-tooltip:left="{ html: 'View archived threads' }" href="{{ route('forums.trashed') }}"><v-icon>archive</v-icon></v-btn>
        @endcan
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12 sm12 md9>
                <v-card class="elevation-1">
                    <v-card flat v-for="(item, i) in dataset.items" :key="i">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title primary-title class="subheading">
                                <a :href="route(urls.show, item.code)" class="grey--text text--darken-3 no--decoration mb-3" v-html="item.name"></a>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-menu bottom left>
                                <v-btn icon flat slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                                <v-list>
                                    @can('view-forum')
                                        <v-list-tile ripple :href="route(urls.show, (item.code))">
                                            <v-list-tile-action>
                                                <v-icon info>search</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('View details') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    @endcan
                                    @can('edit-forum')
                                        <v-list-tile ripple :href="route(urls.edit, (item.id))">
                                            <v-list-tile-action>
                                                <v-icon accent>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Edit') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    @endcan
                                    @can('destroy-forum')
                                        <v-list-tile ripple @click="$refs[`destroy_${item.id}`].submit()">
                                            <v-list-tile-action>
                                                <v-icon warning>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    <form :id="`destroy_${item.id}`" :ref="`destroy_${item.id}`" :action="route(urls.destroy, item.id)" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        {{ __('Move to Trash') }}
                                                    </form>
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    @endcan
                                </v-list>
                            </v-menu>
                        </v-toolbar>

                        <v-card-text class="body-1 grey--text">
                            <div v-html="item.excerpt"></div>
                        </v-card-text>

                        <v-card-actions>
                            <div v-if="item.category" class="orange--text caption">
                                <a class="orange--text td-n" class="fw-500"
                                    :href="`{{ route('forums.index') }}?category_id=${item.category_id}`"
                                >
                                    <span v-html="item.category.name"></span>
                                </a>
                            </div>
                            <div class="caption">
                                <span class="caption" v-html="item.created"></span>
                                <span class="teal--text caption"> <span class="caption grey--text text--darken-2">{{ __('by') }}</span>
                                    <a class="teal--text td-n caption" :href="`{{ route('forums.index') }}?user_id=${item.user_id}`" v-html="item.author">
                                    </a>
                                </span>
                            </div>
                        </v-card-actions>
                        <v-divider></v-divider>
                    </v-card>
                </v-card>

                @if (request()->all())
                    <p class="mt-2 caption grey--text"><a href="{{ route('forums.index') }}">{{ __('Remove filters') }}</a></p>
                @endif
            </v-flex>

            <v-flex xs12 sm12 md3>
                <v-card class="elevation-1 mb-3">
                    <v-card-actions class="pa-3">
                        <v-spacer></v-spacer>
                        <v-btn primary large href="{{ route('forums.create') }}">{{ __('Ask a Question') }}</v-btn>
                        <v-spacer></v-spacer>
                    </v-card-actions>
                </v-card>

                <v-card height="100%" class="elevation-1">
                    <v-list>
                        <v-subheader class="grey--text text--lighten-1">{{ __('All Categories') }}</v-subheader>
                        <v-list-tile v-for="item in categories" v-bind:key="item.name" :href="`{{ route('forums.index') }}?category_id=${item.id}`" ripple>
                            <v-list-tile-action>
                                <v-icon class="orange--text" v-html="item.icon"></v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content class="dark--text">
                                <v-list-tile-title v-html="item.name"></v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        {{-- <v-divider v-else-if="item.divider"></v-divider> --}}
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection


@push('css')
    <style>
        .main-paginate .pagination__item,
        .main-paginate .pagination__navigation {
            box-shadow: none !important;
        }
        .application--light .pagination__item--active {
            background: #03a9f4 !important;
        }
        .inline {
            display: inline-block;
        }
        .z-index-1 {
            z-index: 1;
        }
        .no--decoration {
            text-decoration: none;
        }
        .list--three-line .list__tile__sub-title {
            -webkit-box-orient: vertical;
        }
        .fw-400 {
            font-weight: 400 !important;
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
                    categories: JSON.parse('{!! json_encode($categories) !!}'),
                    bulk: {
                        destroy: {
                            model: false,
                        },
                    },
                    urls: {
                        edit: '{{ route('forums.edit', 'null') }}',
                        show: '{{ route('forums.show', 'null') }}',
                        destroy: '{{ route('forums.destroy', 'null') }}',
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Feature") }}', align: 'left', value: 'feature' },
                            { text: '{{ __("Title") }}', align: 'left', value: 'title' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Author") }}', align: 'left', value: 'user_id' },
                            { text: '{{ __("Template") }}', align: 'left', value: 'template' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Modified") }}', align: 'left', value: 'modified_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: {{ settings('items_per_page', 15) }},
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                };
            },

            watch: {
                'dataset.pagination': {
                    handler () {
                        this.get();
                    },
                    deep: true
                },

                'dataset.searchform.query': function (filter) {
                    setTimeout(() => {
                        const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            search: filter,
                            sort: sortBy ? sortBy : 'id',
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.forums.all') }}', query)
                            .then((data) => {
                                this.dataset.items = data.items.data ? data.items.data : data.items;
                                this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                                this.dataset.loading = false;
                            });
                    }, 1000);
                },
            },

            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy ? sortBy : 'id',
                        take: rowsPerPage,
                        search: {!! @json_encode(request()->all()) !!},
                    };

                    this.api().get('{{ route('api.forums.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                this.get();
            }
        });
    </script>
@endpush
