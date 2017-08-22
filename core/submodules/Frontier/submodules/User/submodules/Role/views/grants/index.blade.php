@extends("Theme::layouts.admin")

@section("head-title", __('Grants'))
@section("page-title", __('Grants'))

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex sm4 xs12>
            <v-card class="mb-3 elevation-1">
                <v-toolbar class="transparent elevation-0">
                    <v-toolbar-title class="accent--text"><v-icon class="accent--text">build</v-icon><span v-tooltip:bottom="{'html': 'Automatic Grant-Permission Provisioning'}">{{ __("Automatic Grant-Permission Provisioning") }}</span></v-toolbar-title>
                </v-toolbar>
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

            <v-card class="mb-3 elevation-1">
                <v-toolbar class="transparent elevation-0">
                    <v-toolbar-title class="accent--text">{{ __("New Grant") }}</v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                    <form action="{{ route('grants.store') }}" method="POST">
                        {{ csrf_field() }}
                        <p class="subtitle grey--text">{{ __("Need to add a new fine-tuned Grant? Use the form below.") }}</p>
                        <v-text-field
                            :error-messages="resource.errors.name"
                            label="{{ _('Name') }}"
                            name="name"
                            persistent-hint
                            value="{{ old('name') }}"
                            @input="val => { resource.item.name = val; }"
                        ></v-text-field>
                        <v-text-field
                            :error-messages="resource.errors.code"
                            :value="resource.item.name ? resource.item.name : '{{ old('code') }}' | slugify"
                            hint="{{ __('Will be used as an ID for Granting Roles. Make sure the code is unique.') }}"
                            label="{{ _('Code') }}"
                            name="code"
                        ></v-text-field>
                        <v-text-field
                            :error-messages="resource.errors.description"
                            label="{{ _('Short Description') }}"
                            name="description"
                            value="{{ old('description') }}"
                        ></v-text-field>
                        <v-select
                            :error-messages="resource.errors.permissions"
                            auto
                            autocomplete
                            chips
                            item-text="name"
                            item-value="id"
                            label="{{ __('Permissions') }}"
                            max-height="90vh"
                            multiple
                            v-bind:items="suppliments.permissions.items"
                            v-model="suppliments.permissions.selected"
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
            <v-card class="mb-3 elevation-1">
                <v-toolbar class="transparent elevation-0">
                    <v-toolbar-title class="accent--text">{{ __('Grants') }}</v-toolbar-title>
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

                    {{-- View Trashed --}}
                    <a
                        class="btn btn--icon btn--flat theme--light light--bg"
                        light
                        href="{{ route('grants.trash') }}"
                        v-tooltip:left="{'html': `View trashed items`}"
                    >
                        <span class="btn__content"><v-icon>archive</v-icon></span>
                    </a>
                    {{-- /View Trashed --}}
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
                        <td><strong v-tooltip:bottom="{'html': prop.item.description ? prop.item.description : prop.item.name}">@{{ prop.item.name }}</strong></td>
                        <td>@{{ prop.item.code }}</td>
                        <td>@{{ prop.item.description }}</td>
                        <td class="text-xs-right">
                            <span v-tooltip:bottom="{'html': 'Number of permissions associated'}">@{{ prop.item.permissions.length }}</span>
                        </td>
                        <td>@{{ prop.item.created }}</td>
                        <td width="100%" class="text-xs-center">
                            <a v-tooltip:bottom="{'html': 'Show'}" class="btn btn--flat btn--icon" :href="route(urls.grants.show, (prop.item.id))"><span class="btn__content"><v-icon info>search</v-icon></span></a>
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
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Excerpt") }}', align: 'left', value: 'description' },
                            { text: '{{ __("Grants") }}', align: 'left', value: 'grants' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 5,
                            take: 5,
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
                        permissions: {
                            items: [],
                            search: '',
                            selected: [],
                        },
                    },
                    urls: {
                        grants: {
                            show: '{{ route('grants.show', 'null') }}',
                            edit: '{{ route('grants.edit', 'null') }}',
                            destroy: '{{ route('grants.destroy', 'null') }}',
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
                        const { sortBy, descending, page, rowsPerPage, totalItems } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            q: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.grants.search') }}', query)
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
                    this.api().get('{{ route('api.grants.all') }}', query)
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
                        g.push({ text: items[i], id: i, name: items[i], value: i});
                    }
                    this.suppliments.permissions.items = g;
                    console.log("this.suppliments.permissions.items", g);

                    let selected = {!! json_encode(old('permissions')) !!};
                    let s = [];
                    if (selected) {
                        for (var i = 0; i < selected.length; i++) {
                            s.push(selected[i].toString());
                        }
                    }
                    this.suppliments.permissions.selected = s ? s : [];
                },
            },

            mounted () {
                this.get();
                this.mountSuppliments();
                console.log("dataset.pagination", this.dataset.pagination);
            }
        });
    </script>
@endpush
