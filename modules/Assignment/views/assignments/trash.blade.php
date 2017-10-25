@include("Theme::partials.backdrop")
@extends("Theme::layouts.admin")

@section("head-title", __('Trashed Assignments'))
@section("page-title", __('Trashed Assignments'))

@push("utilitybar")
    {{--  --}}
@endpush

@section("content")
    @include("Theme::partials.banner")
    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="mb-3">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('Trashed Assignments') }}</v-toolbar-title>
                        <v-spacer></v-spacer>

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

                        {{-- Batch Commands --}}
                        <v-btn
                            v-show="dataset.selected.length < 2"
                            flat
                            icon
                            v-model="bulk.delete.model"
                            :class="bulk.delete.model ? 'btn--active light-blue light-blue--text' : ''"
                            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checboxes') }}'}"
                            @click.native="bulk.delete.model = !bulk.delete.model"
                        ><v-icon>@{{ bulk.delete.model ? 'check_circle' : 'check_circle' }}</v-icon></v-btn>
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <div>
                                    {{-- Bulk Restore --}}
                                    <form action="{{ route('assignments.many.restore') }}" method="POST" class="inline">
                                        {{ csrf_field() }}
                                        <template v-for="item in dataset.selected">
                                            <input type="hidden" name="assignments[]" :value="item.id">
                                        </template>
                                        <button type="submit" v-tooltip:left="{'html': `Restore ${dataset.selected.length} selected items`}" class="btn btn--flat btn--icon"><span class="btn__content"><v-icon info>restore</v-icon></span></button>
                                    </form>
                                    {{-- /Bulk Restore --}}

                                    {{-- Bulk Delete --}}
                                    <v-dialog v-model="dataset.dialog.model" lazy width="auto">
                                        <v-btn flat icon slot="activator" v-tooltip:left="{'html': `Permanently delete ${dataset.selected.length} selected items`}">
                                            <v-icon class="error--text">delete_forever</v-icon>
                                        </v-btn>
                                        <v-card>
                                            <v-card-text class="text-xs-center">
                                                <p class="headline ma-4"><v-icon round class="error white--text" style="font-size: 80px; border-radius: 50%; padding: 10px;">delete_forever</v-icon></p>
                                                <p class="title">{{ __('Permanently Delete') }}</p>
                                                <p class="grey--text text--darken-1">
                                                    {{ __("You are about to permanently delete the resources. This action is irreversible. Do you want to proceed?") }}
                                                </p>
                                            </v-card-text>
                                            <v-divider></v-divider>
                                            <v-card-actions>
                                                <v-btn class="grey--text darken-1" flat @click.native.stop="dataset.dialog.model=false">{{ __('Cancel') }}</v-btn>
                                                <v-spacer></v-spacer>
                                                <form action="{{ route('assignments.many.delete') }}" method="POST" class="inline">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <template v-for="item in dataset.selected">
                                                        <input type="hidden" name="assignments[]" :value="item.id">
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
                    </v-toolbar>

                    <v-data-table
                        :loading="dataset.loading"
                        v-bind="bulk.delete.model?{'select-all':'primary'}:[]"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
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
                            <td v-show="bulk.delete.model">
                                <v-checkbox
                                    color="primary"
                                    hide-details
                                    class="pa-0"
                                    v-model="prop.selected"
                                ></v-checkbox>
                            </td>
                            <td>@{{ prop.item.id }}</td>
                            <td width="20%"><strong v-tooltip:bottom="{ html: 'Show Detail' }">@{{ prop.item.name }}</strong></td>
                            <td width="auto">
                                <v-chip avatar class="ma-0 transparent">
                                    <v-avatar>
                                      <img src="https://placeimg.com/640/480/people/grayscale/1">
                                    </v-avatar>
                                    Paul Smith
                                </v-chip>
                            </td>
                            <td>DPE SUP</td>
                            <td>@{{ prop.item.created }}</td>
                            <td>September 30, 2017</td>
                            <td><v-chip small label class="ma-0 green white--text elevation-0">Submitted</v-chip></td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator" v-tooltip:bottom="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile ripple @click="post(route(urls.assignments.api.restore, (prop.item.id)))">
                                            <v-list-tile-action>
                                                <v-icon info>restore</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Restore') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple @click="setDialog(true, prop.item)">
                                            <v-list-tile-action>
                                                <v-icon error>delete_forever</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Permanently Delete') }}
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

    {{-- single delete --}}
    <v-dialog v-model="resource.dialog.model" persistent lazy width="auto" min-width="200px">
        <v-card class="text-xs-center">
            <v-card-text >
                <p class="headline ma-4"><v-icon round class="error white--text" style="font-size: 80px; border-radius: 50%; padding: 10px;">delete_forever</v-icon></p>
                <p class="title">{{ __('Permanently Delete') }} "@{{ resource.dialog.data.name }}"</p>
                <p class="grey--text text--darken-1">
                    {{ __("You are about to permanently delete the resource. This action is irreversible. Do you want to proceed?") }}
                </p>
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions>
                <v-btn class="green--text darken-1" flat @click.native="resource.dialog.model=false">{{ __('Cancel') }}</v-btn>
                <v-spacer></v-spacer>
                <form :action="route(urls.assignments.delete, (resource.dialog.data.id))" method="POST" class="inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <v-btn type="submit" flat class="error error--text">{{ __('Delete Forever') }}</v-btn>
                </form>
            </v-card-actions>
        </v-card>
    </v-dialog>

    {{-- end signle delete --}}
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
                    bulk: {
                        delete: {
                            model: false,
                        },
                    },
                    dataset: {
                        dialog: {
                            model: false,
                        },
                        bulk: {
                            model: false,
                        },
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Title") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Trainer") }}', align: 'left', value: 'trainer' },
                            { text: '{{ __("Course") }}', align: 'left', value: 'course' },
                            { text: '{{ __("Date Started") }}', align: 'left', value: 'date_started' },
                            { text: '{{ __("Date Due") }}', align: 'left', value: 'date_due' },
                            { text: '{{ __("Status") }}', align: 'left', value: 'status' },
                            { text: '{{ __("Actions") }}', align: 'left', sortable: false, value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 5,
                            totalItems: 0,
                            trashedOnly: true,
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
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        dialog: {
                            model: false,
                            data: {},
                        }
                    },
                    urls: {
                        assignments: {
                            api: {
                                restore: '{{ route('api.assignments.restore', 'null') }}',
                                delete: '{{ route('api.assignments.delete', 'null') }}',
                            },
                            restore: '{{ route('assignments.restore', 'null') }}',
                            delete: '{{ route('assignments.delete', 'null') }}',
                        },
                    },

                    snackbar: {
                        model: false,
                        text: '',
                        context: '',
                        timeout: 2000,
                        y: 'bottom',
                        x: 'right'
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
                            trashedOnly: this.dataset.pagination.trashedOnly,
                        };

                        this.api().search('{{ route('api.assignments.search') }}', query)
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
                    this.api().get('{{ route('api.assignments.all') }}', this.dataset.pagination)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },

                post (url, query) {
                    var self = this;
                    this.api().post(url, query)
                        .then((data) => {
                            console.log(data);
                            self.get('{{ route('api.assignments.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.items);
                            self.snackbar.model = true;
                        });
                },

                destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.assignments.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data);
                            self.snackbar.model = true;
                        });
                },

                setDialog (model, data) {
                    this.resource.dialog.model = model;
                    this.resource.dialog.data = data;
                },
            },

            mounted () {
                this.get();
            },
        });
    </script>
@endpush
