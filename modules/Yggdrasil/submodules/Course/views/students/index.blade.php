@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            {{-- <v-flex md3 xs12>
                <v-card class="elevation-1">
                    <v-toolbar flat class="transparent">
                        <v-toolbar-title class="subheading">{{ __("Create") }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                            :error-messages="resource.errors.name"
                            label="{{ __('Name') }}"
                            name="name"
                            v-model="resource.item.name"
                            @input="resource.item.code = $options.filters.slugify(resource.item.name)"
                        ></v-text-field>

                        <v-text-field
                            :error-messages="resource.errors.code"
                            label="{{ __('Code') }}"
                            name="code"
                            v-model="resource.item.code"
                        ></v-text-field>

                        <v-text-field
                            :error-messages="resource.errors.alias"
                            label="{{ __('Alias') }}"
                            name="alias"
                            v-model="resource.item.alias"
                        ></v-text-field>

                        <v-text-field
                            :error-messages="resource.errors.description"
                            label="{{ __('Description') }}"
                            name="description"
                            v-model="resource.item.description"
                        ></v-text-field>

                        <v-menu full-width offset-y offset-x>
                            <v-text-field
                                :append-icon="resource.item.icon ? resource.item.icon : 'more_horiz'"
                                :error-messages="resource.errors.icon"
                                hint="{{ __('Click to show list of default icons') }}"
                                label="{{ __('Icon') }}"
                                name="icon"
                                persistent-hint
                                slot="activator"
                                v-model="resource.item.icon"
                            ></v-text-field>
                            <v-card>
                                <v-list>
                                    <v-list-tile ripple @click="resource.item.icon = icon" :key="i" v-for="(icon, i) in misc.icons">
                                        <v-list-tile-avatar>
                                            <v-icon v-html="icon"></v-icon>
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>
                                            <span v-html="icon"></span>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-menu>
                        <input type="hidden" name="type" value="{{ $type ?? 'forums' }}">
                    </v-card-text>
                    <v-card-actions class="pa-3">
                        <v-spacer></v-spacer>
                        <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex> --}}

            <v-flex xs12>
                <v-card class="mb-3 elevation-1">
                    {{-- search --}}
                    <v-text-field
                        solo
                        label="Search"
                        append-icon=""
                        prepend-icon="search"
                        class="pa-2 elevation-1 search-bar"
                        v-model="dataset.searchform.query"
                        clearable
                    ></v-text-field>
                    {{-- /search --}}

                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
                        v-bind="bulk.destroy.model?{'select-all':'primary'}:[]"
                        v-bind:headers="dataset.headers"
                        v-bind:items="dataset.items"
                        v-bind:pagination.sync="dataset.pagination"
                        v-model="dataset.selected">
                        <template slot="headerCell" scope="props">
                            <span v-tooltip:bottom="{'html': props.header.text}">
                                @{{ props.header.text }}
                            </span>
                        </template>
                        <template slot="items" scope="prop">
                            <td v-show="bulk.destroy.model"><v-checkbox hide-details class="primary--text" v-model="prop.selected"></v-checkbox></td>
                            <td v-html="prop.item.id"></td>
                            <td v-html="prop.item.created"></td>
                            <td v-html="prop.item.modified"></td>
                        </template>
                    </v-data-table>
                </v-card>
                @if (\Illuminate\Support\Facades\Request::all())
                    <v-btn error flat href="{{ route('students.index') }}" class="">
                        <v-icon left>remove_circle_outline</v-icon>
                        {{ __('Remove filter') }}
                    </v-btn>
                @endif
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .search-bar label{
            padding-top: 8px;
            padding-bottom: 8px;
            padding-left: 25px !important;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
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
                            { text: '{{ __("Title") }}', align: 'left', value: 'title' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Author") }}', align: 'left', value: 'user_id' },
                            { text: '{{ __("Method") }}', align: 'left', value: 'method' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Modified") }}', align: 'left', value: 'modified_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: '{{ settings('items_per_page', 15) }}',
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
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.students.all') }}', query)
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
                        search: {!! @json_encode(\Illuminate\Support\Facades\Request::all()) !!},
                    };
                    this.api().get('{{ route('api.students.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                // this.get();
            }
        });
    </script>

@endpush
