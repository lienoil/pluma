@extends("Frontier::layouts.admin")

@section("head-title", __('Permissions'))
@section("page-title", __('Permissions'))

@push("utilitybar")
    {{-- <a class="btn btn--raised primary white--text" href="{{ route('permissions.refresh') }}">Refresh</a> --}}
@endpush

@section("content")
    @include("Frontier::partials.banner")

    <v-layout row wrap>
        <v-flex sm8>
            <v-card class="mb-3">
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
        <v-flex sm4>
            <v-card class="mb-3">
                <v-card-title class="primary--text"><strong>{{ __("Refresh Permissions") }}</strong></v-card-title>
                <v-card-text>
                    <form action="{{ route('permissions.refresh.refresh') }}" method="POST">
                        {{ csrf_field() }}
                        <p class="grey--text">{{ __("Refreshing will add and/or update all new permissions specified by the modules you've installed. Existing permissions will not be removed. Doing this action is relatively safe.") }}</p>

                        <div class="text-sm-right">
                            <button type="submit" class="btn btn--raised primary ma-0">Refresh</button>
                        </div>
                        {{-- <a class="btn btn--raised primary white--text ma-0 mb-3" href="{{ route('permissions.refresh.index') }}">Refresh</a> --}}
                    </form>
                </v-card-text>
            </v-card>

            <v-card class="error mb-3" dark>
                <v-card-title><strong><v-icon>priority_high</v-icon>{{ __("Reset Permissions") }}</strong></v-card-title>
                <v-card-text>
                    <form action="{{ route('permissions.refresh.refresh') }}" method="POST" class="text-sm-right">
                        {{ csrf_field() }}
                        <p>{{ __("Resetting will remove all existing permissions from the database. Then it will re-populate the database with all of the permissions defined from the modules you've installed. Doing this will not reset the roles you've created - you have to manually redefine each roles again. Proceed with caution!") }}</p>
                        <button type="submit" class="btn btn--raised white ma-0">Reset</button>
                    </form>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
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
