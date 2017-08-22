@extends("Theme::layouts.admin")

@section("head-title", __('Edit Grant'))
@section("page-title", __('Edit Grant'))

@push("page-settings")
    <v-card>
        <v-card-text>
            <h5 class="headline">
                {{ __($application->page->title) }}
            </h5>
            {{--  --}}
        </v-card-text>
    </v-layout>
@endpush

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex sm10 offset-sm1>
            <v-card class="grey--text elevation-1 mb-2">
                <v-toolbar class="transparent elevation-0">
                    <v-toolbar-title class="accent--text">{{ __('Edit Grant') }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <form action="{{ route('grants.update', $resource->id) }}" method="POST">
                    <v-card-text>
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <v-text-field
                            :error-messages="resource.errors.name"
                            label="Name"
                            name="name"
                            value="{{ $resource->name }}"
                            @input="(val) => { resource.item.name = val; }"
                        ></v-text-field>
                        <v-text-field
                            :error-messages="resource.errors.code"
                            hint="{{ __('Will be used as an ID for Grants. Make sure the code is unique.') }}"
                            label="Code"
                            name="code"
                            :value="resource.item.name ? resource.item.name : '{{ $resource->code }}' | slugify"
                        ></v-text-field>
                        <v-text-field
                            :error-messages="resource.errors.description"
                            label="Description"
                            name="description"
                            value="{{ $resource->description }}"
                        ></v-text-field>
                    </v-card-text>

                    <v-layout row wrap>
                        <v-flex sm6>
                            <v-subheader><strong>{{ __('Available Permissions') }}</strong></v-subheader>

                            {{-- Permissions Table --}}
                            <v-card-text>
                                <v-text-field
                                    append-icon="search"
                                    label="{{ _('Search') }}"
                                    single-line
                                    hide-details
                                    v-model="dataset.searchform.query"
                                    light
                                    class="pb-0"
                                ></v-text-field>
                            </v-card-text>
                            <v-data-table
                                :loading="dataset.loading"
                                :total-items="dataset.totalItems"
                                class="elevation-0"
                                no-data-text="{{ _('No available permissions') }}"
                                {{-- select-all --}}
                                selected-key="id"
                                v-bind:headers="dataset.headers"
                                v-bind:items="dataset.items"
                                v-bind:search="dataset.searchform.query"
                                {{-- v-bind:pagination.sync="dataset.pagination" --}}
                                v-model="dataset.selected"
                            >
                                <template slot="items" scope="prop">
                                    <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                                        {{-- <td>
                                            <v-checkbox
                                                primary
                                                hide-details
                                                class="pa-0"
                                                :input-value="prop.selected"
                                            ></v-checkbox>
                                        </td> --}}
                                        <td role="button"><strong>@{{ prop.item.code }}</strong></td>
                                        <td>@{{ prop.item.description }}</td>
                                    </tr>
                                </template>
                            </v-data-table>
                            {{-- /Permissions Table --}}

                        </v-flex>
                        <v-flex sm6>
                            <v-subheader><strong>{{ __('Chosen Permissions') }}</strong></v-subheader>

                            {{-- Permissions Table --}}
                            <v-card-text>
                                <v-text-field
                                    append-icon="search"
                                    label="{{ _('Search') }}"
                                    single-line
                                    hide-details
                                    v-model="selected.searchform.query"
                                    light
                                    select-all
                                    class="pb-0"
                                ></v-text-field>
                            </v-card-text>
                            <v-data-table
                                :loading="selected.loading"
                                class="elevation-0"
                                no-data-text="{{ _('No resource found') }}"
                                selected-key="id"
                                {{-- select-all --}}
                                v-bind:headers="selected.headers"
                                v-bind:items="selected.items"
                                v-bind:search="selected.searchform.query"
                                v-model="selected.selected"
                                hide-actions
                            >
                                <template slot="items" scope="prop">
                                    <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                                        {{-- <td>
                                            <v-checkbox
                                                primary
                                                hide-details
                                                class="pa-0"
                                                :input-value="prop.selected"
                                            ></v-checkbox>
                                        </td> --}}
                                        <td>
                                            <strong>@{{ prop.item.code }}</strong>
                                        </td>
                                        <td>@{{ prop.item.description }}</td>
                                        <td>
                                            <v-btn
                                                v-tooltip:left="{'html': '{{ __('Remove') }}'}"
                                                flat
                                                icon
                                                @click.native="selected.items.pop(prop.item)"
                                            ><v-icon>close</v-icon></v-btn>
                                        </td>
                                    </tr>
                                </template>
                            </v-data-table>
                            {{-- /Permissions Table --}}

                        </v-flex>
                    </v-layout>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" primary>{{ __('Update') }}</v-btn>
                    </v-card-actions>
                </form>
            </v-card>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    dataset: {
                        headers: [
                            { text: '{{ __("Code") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Description") }}', align: 'left', value: 'code' },
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
                        selected: {!! json_encode(old('roles')) !!} ? {!! json_encode(old('roles')) !!} : [],
                        totalItems: 0,
                    },
                    selected: {
                        headers: [
                            { text: '{{ __("Code") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Description") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Actions") }}', align: 'center', value: 'actions' },
                        ],
                        items: [],
                        loading: false,
                        pagination: {
                            rowsPerPage: 10,
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: {!! json_encode(old('roles')) !!} ? {!! json_encode(old('roles')) !!} : [],
                        totalItems: 0,
                    },
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            permissions: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        dialog: {
                            model: false,
                        },
                    },
                    suppliments: {
                        permissions: {
                            items: [],
                            selected: [],
                        }
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

                // 'dataset.searchform.query': function (filter) {
                //     setTimeout(() => {
                //         const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                //         let query = {
                //             descending: descending,
                //             page: page,
                //             q: filter,
                //             sort: sortBy,
                //             take: rowsPerPage,
                //         };

                //         this.api().search('{{ route('api.permissions.search') }}', query)
                //             .then((data) => {
                //                 this.dataset.items = data.items.data ? data.items.data : data.items;
                //                 this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                //                 this.dataset.loading = false;
                //             });
                //     }, 1000);
                // },
            },

            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy ? sortBy : 'name',
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.permissions.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
                mountSuppliments () {
                    let items = {!! json_encode($permissions) !!};
                    let g = [];
                    for (var i in items) {
                        g.push({ text: items[i], value: i});
                    }
                    this.suppliments.permissions.items = g;

                    let selected = {!! json_encode($resource->permissions->pluck('id')) !!};
                    let s = [];
                    for (var i = 0; i < selected.length; i++) {
                        s.push(selected[i].toString());
                    }
                    this.suppliments.permissions.selected = s ? s : [];

                },
            },

            mounted () {
                this.get();
                this.mountSuppliments();
            }
        });
    </script>
@endpush
