@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm3>
                <form action="{{ route('fieldtypes.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="elevation-1">
                        <v-toolbar flat class="transparent">
                            <v-toolbar-title class="subheading">{{ __("New Fieldtype") }}</v-toolbar-title>
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
                                :error-messages="resource.errors.template"
                                label="{{ __('Template') }}"
                                name="template"
                                v-model="resource.item.template"
                                multi-line
                            ></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>
            <v-flex sm9>

                <v-card class="mb-3 elevation-1">
                    <v-toolbar flat class="transparent">
                        <v-toolbar-title class="subheading">{{ __('All Field Types') }}</v-toolbar-title>
                        <v-spacer></v-spacer>

                        {{-- Batch Commands --}}
                        <v-btn
                            v-show="dataset.selected.length < 2"
                            flat
                            icon
                            v-model="bulk.commands.model"
                            :class="bulk.commands.model ? 'btn--active error error--text' : ''"
                            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checboxes') }}'}"
                            @click.native="bulk.commands.model = !bulk.commands.model"
                        ><v-icon>@{{ bulk.commands.model ? 'indeterminate_check_box' : 'check_box_outline_blank' }}</v-icon></v-btn>

                        {{-- Bulk Delete --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <form ref="deletemanyform" :action="route(urls.fieldtypes.destroy, false)" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="id[]" :value="item.id">
                                    </template>
                                    <v-dialog full-width ref="permamanybox">
                                        <v-btn flat icon slot="activator" v-tooltip:left="{'html': `Permanently delete ${dataset.selected.length} selected items`}"><v-icon error>delete_sweep</v-icon></v-btn>
                                        <v-card>
                                            <v-card-text>
                                                {{ __('You are about to permanently delete items. Are you sure you want to proceed?') }}
                                            </v-card-text>
                                            <v-card-actions>
                                                <v-spacer></v-spacer>
                                                <v-btn flat error @click="$refs.deletemanyform.submit()">{{ __('Yes') }}</v-btn>
                                                <v-btn flat @click="$refs.permamanybox = null">{{ __('Cancel') }}</v-btn>
                                            </v-card-actions>
                                        </v-card>
                                    </v-dialog>
                                </form>
                            </template>
                        </v-slide-y-transition>
                        {{-- /Bulk Delete --}}
                        {{-- /Batch Commands --}}

                        {{-- Search --}}
                        <v-text-field
                            append-icon="search"
                            label="{{ _('Search') }}"
                            single-line
                            hide-details
                            v-if="dataset.searchform.model"
                            v-model="dataset.searchform.query"
                            light
                        ></v-text-field>
                        <v-btn v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" icon flat light @click.native="dataset.searchform.model = !dataset.searchform.model; dataset.searchform.query = '';">
                            <v-icon>@{{ !dataset.searchform.model ? 'search' : 'clear' }}</v-icon>
                        </v-btn>
                        {{-- /Search --}}
                    </v-toolbar>
                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
                        v-bind="bulk.commands.model?{'select-all':'primary'}:[]"
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
                            <td v-show="bulk.commands.model"><v-checkbox hide-details class="primary--text" v-model="prop.selected"></v-checkbox></td>
                            <td v-html="prop.item.id"></td>
                            <td><code v-html="prop.item.name" class="elevation-1"></code></td>
                            <td v-html="prop.item.code"></td>
                            <td v-html="prop.item.created"></td>
                            <td v-html="prop.item.modified"></td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile :href="route(urls.fieldtypes.edit, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon accent>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Edit') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple @click="$refs.delete.submit()">
                                            <v-list-tile-action>
                                                <v-icon warning>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    <form ref="delete" :action="route(urls.fieldtypes.delete, prop.item.id)" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        {{ __('Delete Permanently') }}
                                                    </form>
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-menu>
                            </td>
                        </template>
                    </v-data-table>
                </v-card>

            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            name: '{{ old('name') }}',
                            code: '{{ old('code') }}',
                            template: '{{ old('template') }}',
                        },
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },

                    bulk: {
                        commands: {
                            model: false,
                        },
                    },

                    urls: {
                        fieldtypes: {
                            edit: '{{ route('fieldtypes.edit', 'null') }}',
                            delete: '{{ route('fieldtypes.delete', 'null') }}',
                        }
                    },

                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
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

                    misc: {
                        icons: [
                            'language',
                            'star',
                            'whatshot',
                            'lightbulb_outline',
                            'label'
                        ],
                    }
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

                        this.api().search('{{ route('api.fieldtypes.search') }}', query)
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
                    this.api().get('{{ route('api.fieldtypes.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                this.get();
            }
        })
    </script>
@endpush
