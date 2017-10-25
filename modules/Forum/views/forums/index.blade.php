@extends("Theme::layouts.admin")

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
            label="Search"
            v-model="dataset.searchform.query"
            v-show="dataset.searchform.model"
            ></v-text-field>
            <v-btn v-show="!dataset.searchform.model" icon v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" @click.native="dataset.searchform.model = !dataset.searchform.model;dataset,searchform.query = '';"><v-icon>search</v-icon></v-btn>
        </template>
        {{-- /Search --}}

        {{-- Sort --}}
        <v-menu transition="slide-y-transition">
            <v-btn icon v-tooltip:bottom="{ html: 'Sort' }" slot="activator"><v-icon>sort</v-icon></v-btn>
            <v-list>
                <v-list-tile v-for="n in 5" :key="n">
                    <v-list-tile-title v-text="'Sort ' + n"></v-list-tile-title>
                </v-list-tile>
            </v-list>
        </v-menu>
        {{-- /Sort --}}

        {{-- checkbox --}}

        <v-btn icon v-tooltip:left="{ html: 'Toggle the bulk command checkboxes' }"><v-icon>check_circle</v-icon></v-btn>
        <v-btn icon v-tooltip:left="{ html: 'View trashed items' }"><v-icon>archive</v-icon></v-btn>
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
                        {{-- <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="subheading"><strong>@{{ item.name }}</strong></v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn icon><v-icon>more_horiz</v-icon></v-btn>
                        </v-toolbar> --}}
                        <v-card-title primary-title relative class="pb-0">
                            <div>
                                <v-btn icon absolute right><v-icon>more_horiz</v-icon></v-btn>
                                {{-- <span><v-checkbox ></v-checkbox></span> --}}
                                <div class="subheading"><a :href="route(urls.forums.show, item.id)" class="grey--text text--darken-3 no--decoration">
                                <strong> @{{ item.name }} </strong></a></div>
                                <span class="grey--text">
                                    <span class="body-1">September 03, 2017 (02:00PM) • by</span>
                                    <span class="teal--text body-2"><a href="" class="teal--text no--decoration">
                                        <strong>Paul Smith</strong></a>
                                    </span>
                                </span>
                            </div>
                        </v-card-title>
                        <v-list three-line>
                            <v-list-tile>
                                <v-list-tile-content>
                                    <v-list-tile-sub-title class="body-1 black--text">@{{ item.description }}</v-list-tile-sub-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                        <v-card-text class="text-xs-right pt-0">
                            <div class="caption grey--text">Tagged:
                                <v-chip label class="grey lighten-3 elevation-0">
                                    <v-icon left class="orange--text">label</v-icon>Workskill SUP
                                </v-chip>
                            </div>
                        </v-card-text>
                        <v-divider></v-divider>
                    </v-card-text>

                    <v-card-text>
                        <div class="text-xs-right elevation-0">
                        <v-pagination circle :length="15" v-model="page" :total-visible="7" class="main-paginate"></v-pagination>
                    </div>
                    </v-card-text>
                </v-card>
            </v-flex>

            <v-flex xs12 sm12 md3>
                <v-card height="100%" class="elevation-1">
                    <v-list>
                        <template v-for="item in categories">
                            <v-list-tile v-if="item.action" v-bind:key="item.title" @click="" ripple>
                                <v-list-tile-action>
                                    <v-icon class="orange--text">@{{ item.action }}</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content class="dark--text">
                                    <v-list-tile-title>@{{ item.title }}</v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-divider v-else-if="item.divider"></v-divider>
                            <v-subheader v-else-if="item.header" v-text="item.header" class="grey--text text--lighten-1"></v-subheader>
                        </template>
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
                            description: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    urls: {
                        forums: {
                            show: '{{ route('forums.show', 'null') }}',
                            edit: '{{ route('forums.edit', 'null') }}',
                            destroy: '{{ route('forums.destroy', 'null') }}',
                        },
                    },
                    categories: [
                        {
                            header: 'Choose Filter'
                        },
                        {
                            action: 'language',
                            title: 'All threads'
                        },
                        {
                            action: 'star',
                            title: 'My favorites'
                        },
                        {
                            action: 'whatshot',
                            title: 'Popular this week'
                        },
                        {
                            action: 'lightbulb_outline',
                            title: 'No replies yet'
                        },
                        {
                            divider: true
                        },
                        {
                            header: 'Course Categories'
                        },
                        {
                            action: 'label',
                            title: 'All Categories'
                        },
                        {
                            action: 'label',
                            title: 'Worskill OPS'
                        },
                        {
                            action: 'label',
                            title: 'Workskill SUP'
                        },
                        {
                            action: 'label',
                            title: 'ICDL',
                        }
                    ],
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

            },
            mounted () {
                this.get();
            }
        });
    </script>
@endpush
