@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>

            <v-flex sm5 md4 xs12>
                <v-card class="elevation-1 mb-3">
                    <v-toolbar card class="transparent">
                        <v-icon class="accent--text">book</v-icon>
                        <v-toolbar-title class="accent--text">{{ __('New Catalogue') }}</v-toolbar-title>
                    </v-toolbar>

                    <form action="{{ route('catalogues.store') }}" method="POST">
                        {{ csrf_field() }}
                        <v-card-text>
                            <v-text-field
                                :error-messages="resource.errors.name"
                                label="{{ _('Name') }}"
                                name="name"
                                value="{{ old('name') }}"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.code"
                                :value="resource.item.name ? resource.item.name : '{{ old('code') }}' | slugify"
                                hint="{{ __('Will be used as a unique catalogue name.') }}"
                                label="{{ _('Code') }}"
                                name="code"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.description"
                                label="{{ _('Short Description') }}"
                                name="description"
                                value="{{ old('description') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.alias"
                                :value="resource.item.name ? resource.item.name : '{{ old('alias') }}'"
                                hint="{{ __('Will be used as an alias.') }}"
                                label="{{ _('Alias') }}"
                                name="alias"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.icon"
                                label="{{ _('Icon') }}"
                                name="icon"
                                value="{{ old('icon') }}"
                            ></v-text-field>

                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary class="elevation-1">{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </form>

                </v-card>
            </v-flex>
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
                    },
                    dataset: {
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
                            rowsPerPage: 10,
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
                            headers: [
                                { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            ],
                            pagination: {
                                rowsPerPage: 10,
                                totalItems: 0,
                            },
                            items: [],
                            selected: [],
                            searchform: {
                                query: '',
                                model: true,
                            }
                        }
                    },
                    urls: {
                        roles: {
                            api: {
                                clone: '{{ route('api.roles.clone', 'null') }}',
                                destroy: '{{ route('api.roles.destroy', 'null') }}',
                            },
                            show: '{{ route('roles.show', 'null') }}',
                            edit: '{{ route('roles.edit', 'null') }}',
                            destroy: '{{ route('roles.destroy', 'null') }}',
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

                        this.api().search('{{ route('api.roles.search') }}', query)
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
                    this.api().get('{{ route('api.roles.all') }}', query)
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
                            self.get('{{ route('api.grants.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.grants.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },
            },

            mounted () {
                this.get();
            },
        });
    </script>
@endpush
