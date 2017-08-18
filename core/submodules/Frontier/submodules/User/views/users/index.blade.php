@extends("Theme::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex sm12>
            <v-card class="mb-3">
                <v-toolbar card class="transparent">
                    <v-toolbar-title class="accent--text">{{ __($application->page->title) }}</v-toolbar-title>
                    <v-spacer></v-spacer>

                    {{-- Create Resource --}}
                    <v-btn primary dark class="elevation-0" href="{{ route('users.create') }}" v-tooltip:left="{'html': `Add new user`}"><v-icon>add</v-icon> {{ __('Create User') }}</v-btn>
                    {{-- /Create Resource --}}

                    {{-- Batch Commands --}}
                    <v-slide-y-transition>
                        <template v-if="dataset.selected.length > 1">
                            {{-- Bulk Delete --}}
                            <form action="{{ route('users.many.destroy') }}" method="POST" class="inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <template v-for="item in dataset.selected">
                                    <input type="hidden" name="users[]" :value="item.id">
                                </template>
                                <button type="submit" v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}" class="btn btn--flat btn--icon"><span class="btn__content"><v-icon warning>delete_sweep</v-icon></span></button>
                            </form>
                            {{-- /Bulk Delete --}}
                        </template>
                    </v-slide-y-transition>
                    {{-- /Batch Commands --}}

                    {{-- Search --}}
                    <v-slide-y-transition>
                        <v-text-field
                            append-icon="search"
                            label="{{ _('Search') }}"
                            single-line
                            hide-details
                            v-if="dataset.searchform.model"
                            v-model="dataset.searchform.query"
                            light
                        ></v-text-field>
                    </v-slide-y-transition>
                    <v-btn v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" icon flat light @click.native="dataset.searchform.model = !dataset.searchform.model; dataset.searchform.query = '';">
                        <v-icon>@{{ !dataset.searchform.model ? 'search' : 'clear' }}</v-icon>
                    </v-btn>
                    {{-- /Search --}}

                    <a
                        class="btn btn--icon btn--flat theme--light light--bg"
                        light
                        href="{{ route('users.trash') }}"
                        v-tooltip:left="{'html': `View trashed items`}"
                    >
                        <span class="btn__content"><v-icon>archive</v-icon></span>
                    </a>
                </v-toolbar>

                <v-data-table
                    :loading="dataset.loading"
                    :total-items="dataset.totalItems"
                    class="elevation-0"
                    no-data-text="{{ _('No resource found') }}"
                    select-all
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
                        <td>
                            <v-checkbox
                                primary
                                hide-details
                                class="pa-0"
                                v-model="prop.selected"
                            ></v-checkbox>
                        </td>
                        <td>@{{ prop.item.id }}</td>
                        <td>
                            <strong v-tooltip:bottom="{'html': prop.item.displayname ? prop.item.displayname : prop.item.propername}">@{{ prop.item.propername }}</strong>
                        </td>
                        <td>@{{ prop.item.username }}</td>
                        <td>@{{ prop.item.email }}</td>
                        <td>@{{ prop.item.displayrole }}</td>
                        <td>@{{ prop.item.created }}</td>
                        <td>@{{ prop.item.modified }}</td>
                        <td width="20%" class="text-xs-center">
                            <a v-tooltip:bottom="{'html': 'Show'}" class="btn btn--flat btn--icon" :href="route(urls.users.show, (prop.item.id))"><span class="btn__content"><v-icon info>search</v-icon></span></a>
                            <a v-tooltip:bottom="{'html': 'Edit'}" class="btn btn--flat btn--icon" :href="route(urls.users.edit, (prop.item.id))"><span class="btn__content"><v-icon class="text--lighten-2">edit</v-icon></span></a>
                            <form :action="route(urls.users.destroy, (prop.item.id))" method="POST" class="inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" v-tooltip:bottom="{'html': 'Move to Trash'}" class="btn btn--icon btn--flat"><span class="btn__content"><v-icon>delete</v-icon></span></button>
                            </form>
                        </td>
                    </template>
                </v-data-table>
            </v-card>
        </v-flex>
    </v-layout>
@endsection


@push('css')
    <style>
        .inline {
            display: inline-block;
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
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Username") }}', align: 'left', value: 'alias' },
                            { text: '{{ __("Email") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Roles") }}', align: 'left', value: 'description' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'grants' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
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
                            grants: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    suppliments: {
                        grants: {
                            items: [],
                            selected: [],
                        }
                    },
                    urls: {
                        users: {
                            show: '{{ route('users.show', 'null') }}',
                            edit: '{{ route('users.edit', 'null') }}',
                            destroy: '{{ route('users.destroy', 'null') }}',
                        },
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

                        this.api().search('{{ route('api.users.search') }}', query)
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

                    this.api().get('{{ route('api.users.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
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
