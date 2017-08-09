@extends("Frontier::layouts.admin")

@section("head-title", __('Trashed Grants'))
@section("page-title", __('Trashed Grants'))

@push("utilitybar")
    {{-- <a class="btn btn--raised primary white--text" href="{{ route('permissions.refresh') }}">Refresh</a> --}}
@endpush

@section("content")
    @include("Frontier::partials.banner")

    <v-layout row wrap>

        <v-flex sm8 xs12>
            <v-card class="mb-3">
                <v-toolbar class="info elevation-0">
                    <v-toolbar-title class="white--text">{{ __('Trashed Grants') }}</v-toolbar-title>
                    <v-spacer></v-spacer>

                    {{-- Batch Commands --}}
                    <v-slide-y-transition>
                        <template v-if="dataset.selected.length > 1">
                            <div>
                                {{-- Bulk Restore --}}
                                <form action="{{ route('grants.many.restore') }}" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="grants[]" :value="item.id">
                                    </template>
                                    <button type="submit" v-tooltip:left="{'html': `Restore ${dataset.selected.length} selected items`}" class="btn btn--flat btn--icon"><span class="btn__content"><v-icon class="white--text">restore</v-icon></span></button>
                                </form>
                                {{-- /Bulk Restore --}}

                                {{-- Bulk Delete --}}
                                <v-dialog v-model="dataset.dialog.model" lazy width="auto">
                                    <v-btn flat icon slot="activator" v-tooltip:left="{'html': `Permanently delete ${dataset.selected.length} selected items`}"><v-icon dark class="white--text">delete_forever</v-icon></v-btn>
                                    <v-card class="text-xs-center">
                                        <v-card-title class="headline">{{ __('Permanent Delete') }}</v-card-title>
                                        <v-card-text >
                                            {{ __("You are about to permanently delete the resources. This action is irreversible. Do you want to proceed?") }}
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <v-btn class="green--text darken-1" flat @click.native.stop="dataset.dialog.model=false">{{ __('Cancel') }}</v-btn>
                                            <form action="{{ route('grants.many.delete') }}" method="POST" class="inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <template v-for="item in dataset.selected">
                                                    <input type="hidden" name="grants[]" :value="item.id">
                                                </template>
                                                <button type="submit" class="btn btn--flat error--text"><span class="btn__content">{{ __('Delete All Selected Forever') }}</span></button>
                                            </form>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                                {{-- /Bulk Delete --}}
                            </div>
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
                            v-if="searchform.model"
                            v-model="search"
                            dark
                        ></v-text-field>
                    </v-slide-y-transition>
                    <v-btn v-tooltip:left="{'html': !searchform.model ? 'Search resources' : 'Clear'}" icon flat dark @click.native="searchform.model = !searchform.model; search = '';">
                        <v-icon>@{{ !searchform.model ? 'search' : 'clear' }}</v-icon>
                    </v-btn>
                    {{-- /Search --}}

                </v-toolbar>

                <v-data-table
                    :loading="loading"
                    :total-items="dataset.pagination.totalItems"
                    class="elevation-0"
                    no-data-text="{{ _('No resource found') }}"
                    select-all
                    selected-key="id"
                    v-bind:headers="headers"
                    v-bind:items="dataset.items"
                    v-bind:pagination.sync="pagination"
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
                        <td><strong v-tooltip:bottom="{'html': prop.item.description ? prop.item.description : prop.item.name}">@{{ prop.item.name }}</strong></td>
                        <td>@{{ prop.item.code }}</td>
                        <td>@{{ prop.item.description }}</td>
                        <td class="text-xs-right">
                            <span v-tooltip:bottom="{'html': 'Number of permissions associated'}">@{{ prop.item.permissions.length }}</span>
                        </td>
                        <td>@{{ prop.item.created }}</td>
                        <td width="100%" class="text-xs-center">
                            <form :action="route(urls.grants.restore, (prop.item.id))" method="POST" class="inline">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn--flat btn--icon" v-tooltip:bottom="{'html': '{{ __('Restore resource') }}'}"><span class="btn__content"><v-icon>restore</v-icon></span></button>
                            </form>
                            <v-dialog v-model="prop.item.dialog" lazy width="auto" min-width="200px">
                                <v-btn flat icon slot="activator" v-tooltip:bottom="{'html': '{{ __('Move to Trash') }}'}"><v-icon>delete_forever</v-icon></v-btn>
                                <v-card class="text-xs-center">
                                    <v-card-title class="headline">{{ __('Permanently Delete') }} "@{{ prop.item.name }}"</v-card-title>
                                    <v-card-text >
                                        {{ __("You are about to permanently delete the resource. This action is irreversible. Do you want to proceed?") }}
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        {{-- <v-btn class="green--text darken-1" flat @click.native="prop.item.dialog=false">{{ __('Cancel') }}</v-btn> --}}
                                        <form :action="route(urls.grants.delete, (prop.item.id))" method="POST" class="inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn--flat error--text"><span class="btn__content">{{ __('Delete Forever') }}</span></button>
                                        </form>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
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
    <script src="{{ assets('frontier/vendor/vue/dist/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    urls: {
                        grants: {
                            show: '{{ route('grants.show', 'null') }}',
                            edit: '{{ route('grants.edit', 'null') }}',
                            destroy: '{{ route('grants.destroy', 'null') }}',
                            delete: '{{ route('grants.delete', 'null') }}',
                            restore: '{{ route('grants.restore', 'null') }}',
                        },
                    },
                    grants: {
                        dialog: {
                            model: false,
                        },
                    },
                    loading: true,
                    search: null,
                    searchform: {
                        model: false,
                        query: '',
                    },
                    headers: [
                        { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                        { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                        { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                        { text: '{{ __("Excerpt") }}', align: 'left', value: 'description' },
                        { text: '{{ __("Permissions") }}', align: 'left', value: 'permissions' },
                        { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                        { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                    ],
                    pagination: {
                        totalItems: 0,
                        rowsPerPage: 5,
                    },
                    dataset: {
                        items: [],
                        selected: [],
                        pagination: {
                            totalItems: 0,
                            rowsPerPage: 5,
                        },
                        dialog: {
                            model: false,
                        },
                    },
                    resource: {
                        name: '',
                        code: '',
                        description: '',
                        model: '',
                        dialog: {
                            model: false,
                        },
                    },
                    permissions: {
                        search: '',
                        selected: JSON.parse('{!! json_encode((old('permissions') ? old('permissions') : [])) !!}'),
                        items: [],
                    },
                };
            },
            watch: {
                search (filter) {
                    setTimeout(() => {
                        let self = this;
                        this.searchFromAPI('{{ route('api.grants.search') }}', {q: filter, trashedOnly: 1})
                            .then((data) => {
                                console.log("watch.search", data);
                                self.dataset.items = data.items;
                                self.dataset.pagination.totalItems = data.total;
                            });
                    }, 800);
                },

                pagination: {
                    handler () {
                        let self = this;
                        this.getDataFromAPI('{{ route('api.grants.trash.all') }}')
                            .then((data) => {
                                // console.log("watch.pagination", data);
                                self.dataset.items = data.items;
                                self.dataset.pagination.totalItems = data.total;
                            });
                    },
                    deep: true
                },
            },
            methods: {
                test () {
                    // alert(this.permissions.selected);
                    console.log("TEST", this.permissions.selected);
                },

                searchFromAPI (url, query) {
                    return new Promise((resolve, reject) => {
                        const {
                            sortBy,
                            descending,
                            page,
                            rowsPerPage,
                            totalItems
                        } = this.pagination;

                        query = query ? query : {};
                        let q = "";
                        for (key in query) {
                            q += '&'+key+'='+query[key];
                        }

                        url = url+'?take='+(rowsPerPage)+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending)+q;
                        this.setDataset(url);

                        let items = this.getDataset();
                        const total = this.pagination.totalItems;

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

                        let query = this.search;
                        url = url+'?take='+rowsPerPage+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending)+'&q='+(query);
                        this.setDataset(url);

                        let items = this.getDataset();
                        const total = this.pagination.totalItems;

                        resolve({items, total});
                    });
                },

                getDataset () {
                    return this.dataset.items;
                },

                setDataset (url) {
                    let self = this;
                    this.loading = true;

                    this.$http.get(url)
                        .then((response) => {
                            // console.log("setDataset", response);
                            self.dataset.items = response.body.data;
                            self.dataset.pagination.totalItems = response.body.total;

                            setTimeout(() => {
                                this.loading = false;
                            }, 800);
                        });
                },
            },
            mounted () {
                let self = this;
                this.getDataFromAPI('{{ route('api.grants.trash.all') }}')
                    .then((data) => {
                        self.dataset.items = data.items;
                        self.dataset.pagination.totalItems = data.total;
                    });
            }
        });
    </script>
@endpush
