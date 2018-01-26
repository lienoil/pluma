@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="mb-3 elevation-1">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __($application->page->title) }}</v-toolbar-title>
                        <v-spacer></v-spacer>

                        {{-- Batch Commands --}}

                        {{-- Search --}}
                        <template>
                            <v-text-field
                                :append-icon-cb="() => {dataset.searchform.model = !dataset.searchform.model}"
                                :prefix="dataset.searchform.prefix"
                                :prepend-icon="dataset.searchform.prepend"
                                append-icon="close"
                                light solo hide-details single-line
                                label="Search"
                                autofocus
                                v-model="dataset.searchform.query"
                                v-show="dataset.searchform.model"
                            ></v-text-field>
                            <v-btn v-show="!dataset.searchform.model" icon v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" @click.native="dataset.searchform.model = !dataset.searchform.model;dataset,searchform.query = '';"><v-icon>search</v-icon></v-btn>
                        </template>
                        {{-- Search --}}

                        <v-btn
                            v-show="dataset.selected.length < 2"
                            flat
                            icon
                            v-model="bulk.commands.model"
                            :class="bulk.commands.model ? 'btn--active error error--text' : ''"
                            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checkboxes') }}'}"
                            @click.native="bulk.commands.model = !bulk.commands.model"
                        ><v-icon>@{{ bulk.commands.model ? 'check_circle' : 'check_circle' }}</v-icon></v-btn>

                        {{-- Bulk Restore --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <form :action="route(urls.forms.restore, false)" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="id[]" :value="item.id">
                                    </template>
                                    <v-btn flat icon type="submit" v-tooltip:left="{'html': `Restore ${dataset.selected.length} selected items`}"><v-icon success>restore</v-icon></v-btn>
                                </form>
                            </template>
                        </v-slide-y-transition>
                        {{-- Bulk Restore --}}

                        {{-- Bulk Delete --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                {{-- Delete --}}
                                <form :action="route(urls.forms.delete, false)" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="id[]" :value="item.id">
                                    </template>
                                    <v-btn flat icon type="submit" v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}"><v-icon error>delete_sweep</v-icon></v-btn>
                                </form>
                            </template>
                        </v-slide-y-transition>
                        {{-- Bulk Delete --}}

                        {{-- Batch Commands --}}



                    </v-toolbar>

                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.pagination.totalItems"
                        class="elevation-0 grey--text"
                        no-data-text="{{ __('No resource found') }}"
                        v-bind="bulk.commands.model?{'select-all':'primary'}:{}"
                        v-bind:headers="dataset.headers"
                        v-bind:items="dataset.items"
                        v-bind:pagination.sync="dataset.pagination"
                        v-model="dataset.selected">
                        <template slot="items" scope="prop">
                            <td class="grey--text text--darken-1" v-show="bulk.commands.model"><v-checkbox hide-details class="primary--text" v-model="prop.selected"></v-checkbox></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.id"></td>
                            <td class="grey--text text--darken-1"><strong v-html="prop.item.name"></strong></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.code"></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.author"></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.template"></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.created"></td>
                            <td class="grey--text text--darken-1" v-html="prop.item.removed"></td>
                            <td class="grey--text text--darken-1 text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile ripple @click="$refs.restore.submit()">
                                            <v-list-tile-action>
                                                <v-icon class="success--text">restore</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    <form ref="restore" :action="route(urls.forms.restore, prop.item.id)" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PATCH') }}
                                                        {{ __('Restore') }}
                                                    </form>
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple @click="$refs.delete.submit()">
                                            <v-list-tile-action>
                                                <v-icon warning>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    <form ref="delete" :action="route(urls.forms.delete, prop.item.id)" method="POST">
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
                    bulk: {
                        commands: {
                            model: false,
                        },
                    },
                    urls: {
                        forms: {
                            restore: '{{ route('forms.restore', 'null') }}',
                            delete: '{{ route('forms.delete', 'null') }}',
                        }
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Title") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Author") }}', align: 'left', value: 'user_id' },
                            { text: '{{ __("Template") }}', align: 'left', value: 'template' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Removed") }}', align: 'left', value: 'deleted_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: {{ settings('rows_per_page', 10) }},
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
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
                            only_trashed: true,
                        };

                        this.api().search('{{ route('api.forms.all') }}', query)
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
                        only_trashed: true,
                    };
                    this.api().get('{{ route('api.forms.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.pagination.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                this.get();
            }
        });
    </script>

@endpush
