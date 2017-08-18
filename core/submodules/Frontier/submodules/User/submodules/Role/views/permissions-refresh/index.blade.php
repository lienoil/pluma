@extends("Frontier::layouts.admin")

@section("head-title", __('Refresh Permissions'))
@section("page-title", __('Refresh Permissions'))

@section("content")
    <v-layout row wrap>
        <v-flex xs6>
            <v-card>
                <v-card-title>
                    {{-- <span>{{ __('Permissions') }}</span> --}}
                    <v-spacer></v-spacer>
                    <v-text-field
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                        v-model="search"
                    ></v-text-field>
                    @can('delete-permissions')
                    <v-btn icon light v-tooltip:bottom="{'html': 'Bulk Delete'}"><v-icon>delete</v-icon></v-btn>
                    @endcan
                </v-card-title>
                <v-data-table
                    :loading="loading"
                    :total-items="totalItems"
                    class="elevation-0"
                    {{-- select-all --}}
                    selected-key="id"
                    v-bind:headers="headers"
                    v-bind:items="dataset"
                    v-bind:pagination.sync="pagination"
                    v-model="selected"
                >
                    <template slot="headerCell" scope="props">
                        <span v-tooltip:bottom="{'html': props.header.text}">
                            @{{ props.header.text }}
                        </span>
                    </template>
                    <template slot="items" scope="prop">
                        {{-- <td>
                            <v-checkbox
                                primary
                                hide-details
                                v-model="prop.selected"
                            ></v-checkbox>
                        </td> --}}
                        <td>@{{ prop.item.id }}</td>
                        <td><strong>@{{ prop.item.name }}</strong></td>
                        <td>@{{ prop.item.code }}</td>
                        <td>@{{ prop.item.description }}</td>
                        <td>@{{ prop.item.created }}</td>
                    </template>
                </v-data-table>
            </v-card>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    loading: true,
                    totalItems: 0,
                    search: null,
                    selected: [],
                    pagination: {
                        rowsPerPage: 5,
                    },
                    headers: [
                        { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                        { text: '{{ __("Title") }}', align: 'left', value: 'name' },
                        { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                        { text: '{{ __("Excerpt") }}', align: 'left', value: 'description' },
                        { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                    ],
                    dataset: [],
                };
            },
            watch: {
                search (filter) {
                    setTimeout(() => {
                        let self = this;
                        this.searchFromAPI('{{ route('api.permissions.search') }}', filter)
                            .then((data) => {
                                console.log("watch.search", data);
                                self.dataset = data.items;
                                self.totalItems = data.total;
                            });
                    }, 1000);
                },

                pagination: {
                    handler () {
                        this.getDataFromAPI('{{ route('api.permissions.all') }}')
                            .then((data) => {
                                console.log("watch.pagination", data);
                                self.dataset = data.items;
                                self.totalItems = data.total;
                            });
                    },
                    deep: true
                },
            },
            methods: {
                searchFromAPI (url, query) {
                    return new Promise((resolve, reject) => {
                        const {
                            sortBy,
                            descending,
                            page,
                            rowsPerPage,
                            totalItems
                        } = this.pagination;

                        url = url+'?take='+(rowsPerPage)+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending)+'&q='+(query);
                        this.setDataset(url);

                        let items = this.getDataset();
                        const total = this.totalItems;

                        resolve({items, total});
                    });
                },

                getDataFromAPI (url) {
                    return new Promise((resolve, reject) => {
                        const {
                            sortBy,
                            descending,
                            page,
                            rowsPerPage,
                            totalItems
                        } = this.pagination;

                        url = url+'?take='+rowsPerPage+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending);
                        this.setDataset(url);

                        let items = this.getDataset();
                        const total = this.totalItems;

                        resolve({items, total});
                    });
                },

                getDataset () {
                    return this.dataset;
                },

                setDataset (url) {
                    let self = this;
                    this.loading = true;

                    this.$http.get(url)
                        .then((response) => {
                            // console.log("setDataset", response);
                            self.dataset = response.body.data;
                            self.totalItems = response.body.total;

                            setTimeout(() => {
                                this.loading = false;
                            }, 1000);
                        });
                },
            },
            mounted () {
                let self = this;
                this.getDataFromAPI('{{ route('api.permissions.all') }}')
                    .then((data) => {
                        self.dataset = data.items;
                        self.totalItems = data.total;
                    });
            }
        });
    </script>
@endpush
