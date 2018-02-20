@extends("Theme::layouts.admin")

@section("head-title", __('Forums'))

@section("content")
    @include("Theme::partials.banner")

    <v-toolbar dark class="secondary elevation-1 sticky">
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
        @can('trashed-forum')
            <v-btn icon v-tooltip:left="{ html: 'View archived threads' }" href="{{ route('forums.trashed') }}"><v-icon>archive</v-icon></v-btn>
        @endcan
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12 sm12 md9>
                <v-card flat class="mb-3 elevation-1 c-lift" v-for="(item, i) in dataset.items" :key="i">

                    {{-- title and actions --}}
                    <v-card-actions class="px-custom-20 py-2">
                        <a :href="route(urls.show, item.code)" class="title fw-400 grey--text text--darken-3 no--decoration pa-0 mb-0">
                            @{{ item.name }}
                        </a>
                        <v-spacer></v-spacer>
                        <v-btn :href="route(urls.edit, (item.id))" icon v-tooltip:bottom="{ html: 'Edit' }"><v-icon>edit</v-icon></v-btn>
                        <form
                            :id="`destroy_${item.id}`"
                            :ref="`destroy_${item.id}`"
                            :action="route(urls.destroy, item.id)"
                            method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <v-btn icon type="submit"  v-tooltip:bottom="{ html: 'Move to Trash' }"><v-icon>delete</v-icon></v-btn>
                        </form>
                    </v-card-actions>
                    {{-- /title and actions --}}

                    {{-- category --}}
                    <v-card-text class="px-4 pt-0">
                        <div v-if="item.category" class="orange--text">
                            <a class="grey--text td-n" class="fw-500"
                                :href="`{{ route('forums.index') }}?category_id=${item.category_id}`">
                                <v-icon class="orange--text mr-2" v-html="item.category.icon"></v-icon><span v-html="item.category.name"></span>
                            </a>
                        </div>
                    </v-card-text>
                    {{-- /category --}}

                    {{-- body --}}
                    <v-card-text class="subheading grey--text text--darken-1 px-4">
                        <div v-html="item.excerpt"></div>
                    </v-card-text>
                    {{-- /body --}}

                    {{-- author and created --}}
                    <v-card-actions class="px-custom-20 py-4">
                        <v-avatar size="30px" class="mr-2"><img :src="item.user.avatar"></v-avatar>
                        <a class="grey--text td-n" :href="`{{ route('forums.index') }}?user_id=${item.user_id}`" v-html="item.author"></a>
                        <v-spacer></v-spacer>
                        <v-icon class="grey--text">schedule</v-icon>
                        <span class="subheading grey--text" v-html="item.created"></span>
                    </v-card-actions>
                    {{-- /author and created --}}
                </v-card>

                @if (request()->all())
                <v-btn error flat href="{{ route('forums.index') }}">
                    <v-icon left>remove_circle_outline</v-icon>
                    {{ __('Remove filter') }}
                </v-btn>
                @endif
            </v-flex>

            <v-flex xs12 sm12 md3>
                <v-card flat class="mb-3 transparent">
                    <v-btn primary block large class="elevation-1 my-0" href="{{ route('forums.create') }}">{{ __('New Discussion') }}</v-btn>
                </v-card>

                <v-card class="elevation-1">
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
        .td-n:hover {
            text-decoration:none !important;
        }
        .px-custom-20 {
            padding-left: 20px !important;
            padding-right: 20px !important;
        }
        .c-lift {
            transition: all .2s ease;
        }
        .c-lift:hover {
            -webkit-transform: translateY(-6px);
            transform: translateY(-6px);
            box-shadow: 0 1px 8px rgba(0,0,0,.2),0 3px 4px rgba(0,0,0,.14),0 3px 3px -2px rgba(0,0,0,.12) !important;
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
