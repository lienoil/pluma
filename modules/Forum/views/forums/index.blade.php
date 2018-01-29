@extends("Theme::layouts.public")

@section("head-title", __('Forums'))
@section("page-title", __('Forums'))

@section("content")
    @include("Theme::partials.banner")
    <v-toolbar dark class="light-blue elevation-1 sticky">
        <v-toolbar-title class="white--text">Forums</v-toolbar-title>
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

        <v-btn icon href="{{ route('forums.create') }}" v-tooltip:left="{ 'html': 'Create Forum' }">
            <v-icon>add</v-icon>
        </v-btn>

        {{-- Sort --}}
        <v-menu transition="slide-y-transition">
            <v-btn icon v-tooltip:left="{ html: 'Sort' }" slot="activator"><v-icon>sort</v-icon></v-btn>
            <v-list>
                <v-list-tile v-for="n in 5" :key="n">
                    <v-list-tile-title v-text="'Sort ' + n"></v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-menu>
        {{-- /Sort --}}

        <v-btn icon v-tooltip:left="{ html: 'Toggle the bulk command checkboxes' }"><v-icon>check_circle</v-icon></v-btn>
        <v-btn icon v-tooltip:left="{ html: 'View trashed items' }" href="{{ route('forums.trash') }}"><v-icon>archive</v-icon></v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12 sm12 md9>
                <v-card
                    class="elevation-1"
                    height="100%">
                    <v-card-text class="pa-0"
                        v-bind="{ [`xs${item.flex}`]: true }"
                        v-for="item in items"
                        :key="item.title">
                         <v-card-text class="pb-0">
                            <div class="title fw-400" style="position: relative;">
                                <a :href="route(urls.forums.show, item.id)" class="grey--text text--darken-3 no--decoration">
                                    @{{ item.name }}
                                </a>
                                <v-menu bottom left style="right: -20px; top: -10px; position: absolute;">
                                    <v-btn right icon flat slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile ripple :href="route(urls.forums.show, (item.id))">
                                            <v-list-tile-action>
                                                <v-icon info>search</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('View details') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple :href="route(urls.forums.edit, (item.id))">
                                            <v-list-tile-action>
                                                <v-icon accent>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Edit') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple
                                            @click="destroy(route(urls.forums.api.destroy, item.id),
                                            {
                                                '_token': '{{ csrf_token() }}'
                                            })">
                                            <v-list-tile-action>
                                                <v-icon warning>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Move to Trash') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-menu>
                            </div>
                            <span class="grey--text caption">
                                <a class="td-n" href="">
                                    <span v-if="item.category" class="orange--text">
                                        <a class="orange--text td-n" class="fw-500"
                                            :href="`{{ route('forums.index') }}?category_id=${item.category_id}`"
                                            :href="`{{ route('forums.index') }}?category_id=${prop.item.category_id}`"
                                            v-html="item.category.name">
                                        </a>
                                    </span>
                                </a> •
                                <span class="caption">@{{ item.created }}</span>
                                <span class="teal--text caption"> <span class="caption grey--text text--darken-2">by</span>
                                    <a class="teal--text td-n caption" :href="`{{ route('forums.index') }}?user_id=${item.user_id}`" v-html="item.author">
                                    </a>
                                </span>
                            </span>
                        </v-card-text>
                        <v-list three-line>
                            <v-list-tile>
                                <v-list-tile-content>
                                    <v-list-tile-sub-title class="body-1 black--text">@{{ item.body }}</v-list-tile-sub-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                        <v-divider></v-divider>
                    </v-card-text>
                </v-card>
                @if (\Illuminate\Support\Facades\Request::all())
                    <p class="caption grey--text"><a href="{{ route('forums.index') }}">{{ __('Remove filters') }}</a></p>
                @endif
            </v-flex>

            <v-flex xs12 sm12 md3>
                <v-card height="100%" class="elevation-1">
                    <v-list>
                        <v-subheader class="grey--text text--lighten-1">{{ __('All Categories') }}</v-subheader>
                        <v-list-tile v-for="item in categories" v-bind:key="item.name" :href="`{{ route('forums.index') }}?category_id=${item.category_id}`" ripple>
                            <v-list-tile-action>
                                <v-icon class="orange--text" v-html="item.icon"></v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content class="dark--text">
                                <v-list-tile-title v-html="item.name"></v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-divider v-else-if="item.divider"></v-divider>
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
                        searchform: {
                            model: false,
                        }
                    },
                    dataset: {
                        bulk: {
                            model: false,
                        },
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 5,
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                    page: 1,
                    ex4: true,
                    items:[],
                    searchform: {
                        model: false,
                        query: '',
                    },
                    divider: true,
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            body: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    urls: {
                        forums: {
                            api: {
                                destroy: '{{ route('api.forums.destroy', 'null') }}',
                            },
                            show: '{{ route('forums.show', 'null') }}',
                            edit: '{{ route('forums.edit', 'null') }}',
                            destroy: '{{ route('forums.destroy', 'null') }}',
                        },
                    },
                }
            },
            watch: {
               'searchform.query': function (filter) {
                    setTimeout(() => {
                        let query = {
                            descending: null,
                            page: null,
                            q: filter,
                            sort: null,
                            take: null,
                        };

                        this.api().search('{{ route('api.forums.search') }}', query)
                            .then((data) => {
                                this.items = data.items.data ? data.items.data : data.items;
                                this.totalItems = data.items.total ? data.items.total : data.total;
                                this.loading = false;
                            });
                    },  1000);
                },

                'dataset.searchform.query': function (filter) {
                    setTimeout(() => {
                        const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            q: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.forums.search') }}', query)
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
                    let query ={
                        descending: null,
                        page: null,
                        sort: null,
                        take: null,
                    }

                    this.api().get('{{ route('api.forums.all') }}', query)
                    .then((data) => {
                        this.items = data.items.data ? data.items.data : data.items;
                        this.totalItems = data.items.total ? data.items.total : data.total;
                    });
                },

                post (url, query) {
                    var self = this;
                    this.api().post(url, query)
                        .then((data) => {
                            self.get('{{ route('api.forums.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.forums.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

            },
            mounted () {
                this.get();
                this.dataset.items = {!! json_encode($resources->toArray()) !!}
            }
        });
    </script>
@endpush
