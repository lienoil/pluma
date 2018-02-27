@extends("Frontier::layouts.admin")

@section("content")

    @include("Theme::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <v-card class="mb-3 elevation-1">
                    {{-- search --}}
                    {{-- <v-text-field
                        solo
                        label="Search"
                        append-icon=""
                        prepend-icon="search"
                        class="pa-2 elevation-1 search-bar"
                        v-model="dataset.searchform.query"
                        clearable
                    ></v-text-field> --}}
                    {{-- /search --}}

                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
                        v-bind="bulk.destroy.model?{'select-all':'primary'}:[]"
                        {{-- selected-key="id" --}}
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
                            <td>
                                <v-avatar size="36px">
                                    <img class="ma-1" v-if="prop.item.feature" :src="prop.item.feature" :alt="prop.item.name">
                                </v-avatar>
                            </td>
                            {{-- <td v-html="prop.item.displayname"></td> --}}
                            {{-- <td v-html="prop.item.code"></td> --}}
                            <td v-html="prop.item.created"></td>
                            <td v-html="prop.item.modified"></td>
                        </template>
                    </v-data-table>
                </v-card>
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
                    urls: {
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Feature") }}', align: 'left', value: 'feature' },
                            { text: '{{ __("Title") }}', align: 'left', value: 'title' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Author") }}', align: 'left', value: 'user_id' },
                            { text: '{{ __("Status") }}', align: 'left', value: 'enrolled' },
                            { text: '{{ __("Category") }}', align: 'left', value: 'category_at' },
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
                        const { sortBy, descending, student, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            student: student,
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
                    const { sortBy, descending, student, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        student: student,
                        sort: sortBy,
                        take: rowsPerPage,
                        search: {!! @json_encode(request()->all()) !!},
                    };
                    this.api().get('{{ route('api.students.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },
        });
    </script>

@endpush
