@extends("Frontier::layouts.admin")

@section("head-title", __('Grants'))
@section("page-title", __('Grants'))

@push("utilitybar")
    {{-- <a class="btn btn--raised primary white--text" href="{{ route('permissions.refresh') }}">Refresh</a> --}}
@endpush

@section("content")
    @include("Frontier::partials.banner")

    <v-layout row wrap>
        <v-flex sm4 xs12>
            <v-card class="mb-3">
                <v-card-title class="primary--text"><strong><v-icon class="primary--text">build</v-icon>{{ __("Automatic Grant-Permission Provisioning") }}</strong></v-card-title>
                <v-card-text>
                    <form action="{{ route('grants.refresh.refresh') }}" method="POST">
                        {{ csrf_field() }}
                        <p class="grey--text">{{ __("Performing this action will automate most of the process of creating and grouping a collection of permissions into Grants. It will base its provisioning on the permissions configuration on each Modules installed.") }}</p>

                        <div class="text-sm-right">
                            <button type="submit" class="btn btn--raised primary ma-0">
                                <span v-tooltip:bottom="{'html': 'Doing this action is relatively safe'}">
                                    Start
                                </span>
                            </button>
                        </div>
                    </form>
                </v-card-text>
            </v-card>

            <v-card class="mb-3">
                <v-card-title class="primary--text"><strong>{{ __("New Grant") }}</strong></v-card-title>
                <v-card-text>
                    <form action="{{ route('grants.store') }}" method="POST">
                        {{ csrf_field() }}
                        <p class="grey--text">{{ __("Need to add a new fine-tuned Grant? Use the form below.") }}</p>
                        <v-text-field
                            label="{{ _('Name') }}"
                            value="{{ old('name') }}"
                            name="name"
                            :error-messages="errors.name"
                            persistent-hint
                            @input="val => { resource.name = val; }"
                        ></v-text-field>
                        <v-text-field
                            label="{{ _('Code') }}"
                            :value="resource.name ? resource.name : '{{ old('code') }}' | slugify"
                            name="code"
                            :error-messages="errors.code"
                            {{-- persistent-hint --}}
                            hint="{{ __('Will be used as an ID for Granting Roles. Make sure the code is unique.') }}"
                        ></v-text-field>
                        <v-text-field
                            label="{{ _('Short Description') }}"
                            value="{{ old('description') }}"
                            name="description"
                            :error-messages="errors.description"
                        ></v-text-field>
                        <v-select
                            auto
                            autocomplete
                            chips
                            item-text="name"
                            item-value="id"
                            label="{{ __('Permissions') }}"
                            max-height="90vh"
                            multiple
                            v-bind:items="permissions.items"
                            v-model="permissions.selected"
                            :error-messages="errors.permissions"
                        >
                            <template slot="selection" scope="data">
                                <v-chip
                                    close
                                    @input="data.parent.selectItem(data.item)"
                                    @click.native.stop
                                    class="chip--select-multi"
                                    :key="data.item"
                                >
                                    <input type="hidden" name="permissions[]" :value="data.item.id">
                                    @{{ data.item.name }}
                                </v-chip>
                            </template>
                            <template slot="item" scope="data">
                                <template v-if="typeof data.item !== 'object'">
                                    <v-list-tile-content v-text="data.item"></v-list-tile-content>
                                </template>
                                <template v-else>
                                    <v-list-tile-content>
                                        <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
                                        <v-list-tile-sub-title v-html="data.item.code"></v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </template>
                            </template>
                        </v-select>

                        <div class="text-sm-right">
                            <button type="submit" class="btn btn--raised primary ma-0"><span class="btn__content">{{ __('Submit') }}</span></button>
                        </div>
                    </form>
                </v-card-text>
            </v-card>

        </v-flex>
        <v-flex sm8 xs12>
            <v-card class="mb-3">
                <v-toolbar class="info elevation-0">
                    <v-toolbar-title class="white--text">{{ __('Grants') }}</v-toolbar-title>
                    <v-spacer></v-spacer>

                    {{-- Batch Commands --}}
                    <v-slide-y-transition>
                        <template v-if="dataset.selected.length > 1">
                            {{-- Bulk Delete --}}
                            <form action="{{ route('grants.many.destroy') }}" method="POST" class="inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <template v-for="item in dataset.selected">
                                    <input type="hidden" name="grants[]" :value="item.id">
                                </template>
                                <button type="submit" v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}" class="btn btn--flat btn--icon"><span class="btn__content"><v-icon dark class="white--text">delete_sweep</v-icon></span></button>
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
                            v-if="searchform.model"
                            v-model="search"
                            dark
                        ></v-text-field>
                    </v-slide-y-transition>
                    <v-btn v-tooltip:left="{'html': !searchform.model ? 'Search resources' : 'Clear'}" icon flat dark @click.native="searchform.model = !searchform.model; search = '';">
                        <v-icon>@{{ !searchform.model ? 'search' : 'clear' }}</v-icon>
                    </v-btn>
                    {{-- /Search --}}

                    <a
                        class="btn btn--icon btn--flat theme--dark dark--bg"
                        dark
                        href="{{ route('grants.trash') }}"
                        v-tooltip:left="{'html': `View trashed items`}"
                    >
                        <span class="btn__content"><v-icon>archive</v-icon></span>
                    </a>
                </v-toolbar>

                {{-- <v-card-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                        append-icon="search"
                        label="{{ _('Search') }}"
                        single-line
                        hide-details
                        v-model="search"
                    ></v-text-field>
                    <v-slide-x-transition>
                        <v-btn
                            @click.native="search = ''"
                            icon
                            light
                            v-show="search"
                            v-tooltip:bottom="{'html': 'Clear Search'}"
                        >
                            <v-icon>clear</v-icon>
                        </v-btn>
                    </v-slide-x-transition>
                </v-card-title> --}}
                <v-data-table
                    :loading="loading"
                    :total-items="dataset.totalItems"
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
                            <a v-tooltip:bottom="{'html': 'Show'}" class="btn btn--flat btn--icon" :href="route(urls.grants.show, (prop.item.id))"><span class="btn__content"><v-icon>search</v-icon></span></a>
                            <a v-tooltip:bottom="{'html': 'Edit'}" class="btn btn--flat btn--icon" :href="route(urls.grants.edit, (prop.item.id))"><span class="btn__content"><v-icon>edit</v-icon></span></a>
                            <form :action="route(urls.grants.destroy, (prop.item.id))" method="POST" class="inline">
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
                    pagination: {
                        rowsPerPage: 5,
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
                    dataset: {
                        items: [],
                        selected: [],
                        totalItems: 0,
                    },
                    resource: {
                        name: '',
                        code: '',
                        description: '',
                        model: '',
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
                        this.searchFromAPI('{{ route('api.grants.search') }}', filter)
                            .then((data) => {
                                console.log("watch.search", data);
                                self.dataset.items = data.items;
                                self.dataset.totalItems = data.total;
                            });
                    }, 1000);
                },

                pagination: {
                    handler () {
                        let self = this;
                        this.getDataFromAPI('{{ route('api.grants.all') }}')
                            .then((data) => {
                                console.log("watch.pagination", data);
                                self.dataset.items = data.items;
                                self.dataset.totalItems = data.total;
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

                        url = url+'?take='+(rowsPerPage)+'&page='+(page)+'&sort='+(sortBy)+'&descending='+(descending)+'&q='+(query);
                        this.setDataset(url);

                        let items = this.getDataset();
                        const total = this.dataset.totalItems;

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
                        const total = this.dataset.totalItems;

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
                            self.dataset.totalItems = response.body.total;

                            setTimeout(() => {
                                this.loading = false;
                            }, 1000);
                        });
                },
            },
            mounted () {
                let self = this;
                this.getDataFromAPI('{{ route('api.grants.all') }}')
                    .then((data) => {
                        self.dataset.items = data.items;
                        self.dataset.totalItems = data.total;
                    });

                this.postResource('{{ route('api.grants.permissions') }}')
                    .then((data) => {
                        let items = [];
                        for (var key in data.items) {
                            items.push({header: key});
                            for (var i = 0; i < data.items[key].length; i++) {
                                items.push(data.items[key][i]);
                            }
                            items.push({divider: true});
                        }
                        self.permissions.items = items;
                    });
            }
        });
    </script>
@endpush
