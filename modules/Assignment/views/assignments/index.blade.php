@include("Theme::partials.backdrop")
@extends("Theme::layouts.admin")

@section("head-title", __('Assignments'))
@section("page-title", __('Assignments'))

@section("content")

    @include("Theme::partials.banner")
    <v-toolbar card dark class="light-blue elevation-1">
        <v-toolbar-title>{{ __($application->page->title) }}</v-toolbar-title>
        <v-spacer></v-spacer>

        {{-- Search --}}
            <template>
            <v-text-field
                :append-icon-cb="() => {dataset.searchform.model = !dataset.searchform.model}"
                :prefix="dataset.searchform.prefix"
                :prepend-icon="dataset.searchform.prepend"
                append-icon="search"
                light solo hide-details single-line
                placeholder="Search"
                v-model="dataset.searchform.query"
                v-show="dataset.searchform.model"
            ></v-text-field>
            <v-btn v-show="!dataset.searchform.model" icon v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" @click.native="dataset.searchform.model = !dataset.searchform.model;dataset,searchform.query = '';"><v-icon>search</v-icon></v-btn>
        </template>
        {{-- /Search --}}

        <v-btn icon v-tooltip:left="{ html: 'Filter' }">
            <v-icon>filter_list</v-icon>
        </v-btn>

        <v-btn icon v-tooltip:left="{ html: 'Sort' }">
            <v-icon>sort</v-icon>
        </v-btn>

        {{-- Batch Commands --}}
        <v-btn
            v-show="dataset.selected.length < 2"
            flat
            icon
            v-model="bulk.destroy.model"
            :class="bulk.destroy.model ? 'btn--active primary primary--text' : ''"
            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checboxes') }}'}"
            @click.native="bulk.destroy.model = !bulk.destroy.model"
        ><v-icon>@{{ bulk.destroy.model ? 'check_circle' : 'check_circle' }}</v-icon></v-btn>
        {{-- Bulk Delete --}}
        <v-slide-y-transition>
            <template v-if="dataset.selected.length > 1">
                <form action="{{ route('assignments.many.destroy') }}" method="POST" class="inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <template v-for="item in dataset.selected">
                        <input type="hidden" name="assignments[]" :value="item.id">
                    </template>
                    <v-btn
                        flat
                        icon
                        type="submit"
                        v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}"
                    ><v-icon warning>delete_sweep</v-icon></v-btn>
                </form>
            </template>
        </v-slide-y-transition>
        {{-- /Bulk Delete --}}
        {{-- /Batch Commands --}}

        {{-- Trashed --}}
        <v-btn
            icon
            flat
            href="{{ route('assignments.trash') }}"
            light
            v-tooltip:left="{'html': `View trashed items`}"
        ><v-icon class="white--text warning--after" v-badge:{{ $trashed }}.overlap>archive</v-icon></v-btn>
        {{-- /Trashed --}}
    </v-toolbar>

    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="elevation-1">

                    <v-data-table
                        :loading="dataset.loading"
                        v-bind="bulk.destroy.model?{'select-all':'primary'}:[]"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
                        selected-key="id"
                        v-bind:headers="dataset.headers"
                        v-bind:items="dataset.items"
                        v-bind:pagination.sync="dataset.pagination"
                        v-model="dataset.selected"
                    >
                        <template slot="headerCell" scope="props">
                            <span v-tooltip:bottom="{'html': props.header.text}">
                                @{{ props.header.text }}
                            </span>
                        </template>
                        <template slot="items" scope="prop">
                            <td v-show="bulk.destroy.model">
                                <v-checkbox
                                    hide-details
                                    color="primary"
                                    class="pa-0"
                                    v-model="prop.selected"
                                ></v-checkbox>
                            </td>
                            <td>@{{ prop.item.id }}</td>
                            <td width="20%">
                                <a class="black--text ripple no-decoration" :href="route(urls.assignments.show, prop.item.id)">
                                   <strong v-tooltip:bottom="{ html: 'Show Detail' }">@{{ prop.item.name }}</strong>
                                </a>
                            </td>
                            <td width="auto">
                                <v-chip avatar class="ma-0 transparent elevation-0">
                                    <v-avatar>
                                      <img src="https://placeimg.com/640/480/people/grayscale/1">
                                    </v-avatar>
                                    Paul Smith
                                </v-chip>
                            </td>
                            <td>DPE SUP</td>
                            <td>@{{ prop.item.created }}</td>
                            <td>September 30, 2017</td>
                            <td><v-chip small label class="ma-0 green white--text elevation-0">Open</v-chip></td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator" v-tooltip:bottom="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile :href="route(urls.assignments.show, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon info>search</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('View details') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile :href="route(urls.assignments.edit, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon accent>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Edit') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile
                                            @click="destroy(route(urls.assignments.api.destroy, prop.item.id),
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
                            </td>
                        </template>
                    </v-data-table>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        td {
            font-size: 14px !important;
        }
        .no-decoration {
            text-decoration: none;
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
                        },
                    },
                    dataset: {
                        bulk: {
                            model: false,
                        },
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Title") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Trainer") }}', align: 'left', value: 'trainer' },
                            { text: '{{ __("Course") }}', align: 'left', value: 'course' },
                            { text: '{{ __("Date Started") }}', align: 'left', value: 'date_started' },
                            { text: '{{ __("Date Due") }}', align: 'left', value: 'date_due' },
                            { text: '{{ __("Status") }}', align: 'left', value: 'status' },
                            { text: '{{ __("Actions") }}', align: 'left', sortable: false, value: 'updated_at' },
                        ],
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
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    urls: {
                        assignments: {
                            api: {
                                destroy: '{{ route('api.assignments.destroy', 'null') }}',
                            },
                            show: '{{ route('assignments.show', 'null') }}',
                            edit: '{{ route('assignments.edit', 'null') }}',
                            destroy: '{{ route('assignments.destroy', 'null') }}',
                        },
                    },

                    snackbar: {
                        model: false,
                        text: '',
                        context: '',
                        timeout: 2000,
                        y: 'bottom',
                        x: 'right'
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
                            q: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.assignments.search') }}', query)
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
                        sort: sortBy,
                        take: rowsPerPage,
                    };

                    this.api().get('{{ route('api.assignments.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },

                post (url, query) {
                    var self = this;
                    this.api().post(url, query)
                        .then((data) => {
                            self.get('{{ route('api.assignments.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.assignments.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

                mountSuppliments () {
                    //
                },
            },

            mounted () {
                this.get();
                this.mountSuppliments();
            },
        });
    </script>
@endpush
