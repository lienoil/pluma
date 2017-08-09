@extends("Frontier::layouts.admin")

@section("head-title", __('Roles'))
@section("page-title", __('Roles'))


@section("content")
    @include("Frontier::partials.banner")

    <v-layout row wrap>
        <v-flex sm3 xs12>

            {{-- <v-card class="mb-3">
                <v-card-title class="primary--text"><strong>{{ __("New Role") }}</strong></v-card-title>
                <v-card-text>
                    <form action="{{ route('roles.store') }}" method="POST">
                        {{ csrf_field() }}
                        <p class="grey--text">{{ __("Need to add a new fine-tuned Role? Use the form below.") }}</p>
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
                            hint="{{ __('Will be used as an ID for Roleing Roles. Make sure the code is unique.') }}"
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
                            v-bind:items="grants.items"
                            v-model="grants.selected"
                            :error-messages="errors.grants"
                        >
                            <template slot="selection" scope="data">
                                <v-chip
                                    close
                                    @input="data.parent.selectItem(data.item)"
                                    @click.native.stop
                                    class="chip--select-multi"
                                    :key="data.item"
                                >
                                    <input type="hidden" name="grants[]" :value="data.item.id">
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
            </v-card> --}}

        </v-flex>
        <v-flex sm9 xs12>
            <v-card class="mb-3">
                <v-toolbar class="info elevation-0">
                    <v-toolbar-title class="white--text">{{ __('Roles') }}</v-toolbar-title>
                    <v-spacer></v-spacer>

                    {{-- Batch Commands --}}
                    <v-slide-y-transition>
                        <template v-if="dataset.selected.length > 1">
                            {{-- Bulk Delete --}}
                            <form action="{{ route('roles.many.destroy') }}" method="POST" class="inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <template v-for="item in dataset.selected">
                                    <input type="hidden" name="roles[]" :value="item.id">
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
                            v-if="dataset.searchform.model"
                            v-model="dataset.searchform.query"
                            dark
                        ></v-text-field>
                    </v-slide-y-transition>
                    <v-btn v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" icon flat dark @click.native="dataset.searchform.model = !dataset.searchform.model; dataset.searchform.query = '';">
                        <v-icon>@{{ !dataset.searchform.model ? 'search' : 'clear' }}</v-icon>
                    </v-btn>
                    {{-- /Search --}}

                    <a
                        class="btn btn--icon btn--flat theme--dark dark--bg"
                        dark
                        href="{{ route('roles.trash') }}"
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
                        <td><strong v-tooltip:bottom="{'html': prop.item.description ? prop.item.description : prop.item.name}">@{{ prop.item.name }}</strong></td>
                        <td>@{{ prop.item.code }}</td>
                        <td>@{{ prop.item.description }}</td>
                        <td class="text-xs-right">
                            <span v-tooltip:bottom="{'html': 'Number of grants associated'}">@{{ prop.item.grants.length }}</span>
                        </td>
                        <td>@{{ prop.item.created }}</td>
                        <td width="100%" class="text-xs-center">
                            <a v-tooltip:bottom="{'html': 'Show'}" class="btn btn--flat btn--icon" :href="route(urls.roles.show, (prop.item.id))"><span class="btn__content"><v-icon>search</v-icon></span></a>
                            <a v-tooltip:bottom="{'html': 'Edit'}" class="btn btn--flat btn--icon" :href="route(urls.roles.edit, (prop.item.id))"><span class="btn__content"><v-icon>edit</v-icon></span></a>
                            <form :action="route(urls.roles.destroy, (prop.item.id))" method="POST" class="inline">
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
    <script src="{{ present('frontier/app/api.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    dataset: {
                        headers: [
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Excerpt") }}', align: 'left', value: 'description' },
                            { text: '{{ __("Grants") }}', align: 'left', value: 'grants' },
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
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
                    pagination: {
                        rowsPerPage: 5,
                    },
                    resource: {
                        item: {},
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    urls: {
                        roles: {
                            show: '{{ route('roles.show', 'null') }}',
                            edit: '{{ route('roles.edit', 'null') }}',
                            destroy: '{{ route('roles.destroy', 'null') }}',
                        },
                    },
                };
            },
            watch: {
                pagination: {
                    handler () {
                        let self = this;
                        this.getDataFromAPI('{{ route('api.roles.all') }}')
                            .then((data) => {
                                console.log("watch.pagination", data);
                                self.dataset.items = data.items;
                                self.dataset.totalItems = data.total;
                            });
                    },
                    deep: true
                },

                search (filter) {
                    setTimeout(() => {
                        this.api.search('{{ route('api.roles.search') }}', {q: filter})
                            .then((data) => {
                                console.log("watch.search", data);
                                this.dataset.items = data.items;
                                this.dataset.totalItems = data.total;
                            });
                    }, 1000);
                },
            },

            methods: {
                api: api,
            },

            mounted () {
                this.api.get('{{ route('api.roles.all') }}', this.dataset.pagination)
                    .then((data) => {
                        this.dataset.items = data.items.data ? data.items.data : data.items;
                        this.dataset.totalItems = data.total;
                        this.dataset.loading = false;
                    });
            }
        });
    </script>
@endpush
