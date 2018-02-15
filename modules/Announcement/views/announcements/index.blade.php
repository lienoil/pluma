@extends("Theme::layouts.public")

@section("content")
    @include("Theme::partials.banner")
    <v-app>


    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card class="mb-3 elevation-1">
                    {{-- Search --}}
                    <v-toolbar
                        color="indigo lighten-1"
                        flat
                        dark
                        tabs
                        >
                        {{-- search --}}
                        <v-text-field
                            solo
                            label="Search"
                            append-icon=""
                            prepend-icon="search"
                            solo-inverted
                            flat
                            v-model="dataset.searchform.query"
                            clearable
                        ></v-text-field>
                        {{-- /search --}}

                        {{-- <v-text-field
                            prepend-icon="search"
                            append-icon="mic"
                            label="Search"
                            solo-inverted
                            class="mx-3"
                            flat
                        ></v-text-field> --}}
                    </v-toolbar>
                    {{-- /Search --}}

                    <v-toolbar dark class="indigo lighten-1 elevation-0 sticky">
                        <v-icon left dark>announcement</v-icon>
                        <v-toolbar-title primary-title>{{ __($application->page->title) }}</v-toolbar-title>

                        <v-spacer></v-spacer>

                        <v-tooltip left>
                            <v-btn
                                href="{{ route('announcements.create') }}"
                                flat
                                icon
                                close-delay="500"
                                open-delay="500"
                                slot="activator">
                                <v-icon>add</v-icon>
                            </v-btn>
                            <span>{{ __('Create') }}</span>
                        </v-tooltip>

                        {{-- Batch Commands --}}

                        <v-tooltip left>
                            <v-btn
                                v-show="dataset.selected.length < 2"
                                flat
                                icon
                                v-model="bulk.destroy.model"
                                :class="bulk.destroy.model ? 'btn--active primary primary--text' : ''"
                                slot="activator"
                                @click.native="bulk.destroy.model = !bulk.destroy.model"
                            ><v-icon>@{{ bulk.destroy.model ? 'check_circle' : 'check_circle' }}</v-icon></v-btn>
                            <span>{{ __('Toggle the bulk command checkboxes') }}</span>
                        </v-tooltip>

                        {{-- Bulk Delete --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <form action="{{ route('announcements.destroy', 'false') }}" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="id[]" :value="item.id">
                                    </template>
                                    <v-tooltip left>
                                        <v-btn
                                            flat
                                            icon
                                            slot="activator"
                                            type="submit"
                                        ><v-icon warning>delete_sweep</v-icon></v-btn>
                                        <span>{{ __('Move ${dataset.selected.length} selected items to Trash') }}</span>
                                    </v-tooltip>
                                </form>
                            </template>
                        </v-slide-y-transition>
                        {{-- /Bulk Delete --}}
                        {{-- /Batch Commands --}}

                        {{-- Trashed --}}
                        <v-tooltip left>
                            <v-btn
                                icon
                                flat
                                href="{{ route('announcements.trashed') }}"
                                dark
                                slot="activator"
                            ><v-icon class="warning--after">archive</v-icon></v-btn>
                            <span>{{ __('View trashed items') }}</span>
                        </v-tooltip>
                        {{-- /Trashed --}}
                    </v-toolbar>

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
                            <v-tooltip bottom>
                                <span slot="activator">@{{ props.header.text }}</span>
                                <span>@{{ props.header.text }}</span>
                            </v-tooltip>
                        </template>
                        <template slot="items" scope="prop">
                            <td v-show="bulk.destroy.model"><v-checkbox hide-details class="primary--text" v-model="prop.selected"></v-checkbox></td>
                            <td v-html="prop.item.id"></td>
                            <td>
                                <v-avatar size="36px">
                                    <img class="ma-1" height="100%" v-if="prop.item.feature" :src="prop.item.feature" :alt="prop.item.name">
                                </v-avatar>
                            </td>
                            <td><a :href="route(urls.edit, (prop.item.id))" class="no-decoration td-n secondary--text"><strong v-html="prop.item.name"></strong></a></td>
                            <td v-html="prop.item.code"></td>
                            <td><a :href="`{{ route('announcements.index') }}?user_id=${prop.item.user_id}`" class="td-n black--text" v-html="prop.item.author"></a></td>
                            <td><span v-if="prop.item.category"><v-icon left class="body-2 mr-1" v-html="prop.item.category.icon"></v-icon><a :href="`{{ route('announcements.index') }}?category_id=${prop.item.category_id}`" class="td-n black--text"><span v-html="prop.item.category.name"></span></span></a></td>
                            <td v-html="prop.item.created"></td>
                            <td v-html="prop.item.modified"></td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator" v-tooltip:left="{html: 'More Actions'}">
                                        <v-icon light>more_vert</v-icon>
                                    </v-btn>
                                    <v-list>
                                        <v-list-tile :href="route(urls.show, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon info>search</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('View details') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile :href="route(urls.edit, (prop.item.id))">
                                            <v-list-tile-action>
                                                <v-icon accent>edit</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{ __('Edit') }}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                        <v-list-tile ripple @click="$refs[`destroy_${prop.item.id}`].submit()">
                                            <v-list-tile-action>
                                                <v-icon warning>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    <form :id="`destroy_${prop.item.id}`" :ref="`destroy_${prop.item.id}`" :action="route(urls.destroy, prop.item.id)" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        {{ __('Move to Trash') }}
                                                        {{-- <v-btn type="submit">{{ __('Move to Trash') }}</v-btn> --}}
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
                @if (request()->all())
                    <v-btn error flat href="{{ route('announcements.index') }}">
                        <v-icon left>remove_circle_outline</v-icon>
                        {{ __('Remove filter') }}
                    </v-btn>
                @endif
            </v-flex>
        </v-layout>
    </v-container>
</v-app>
@endsection

@push('css')
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
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
    <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
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
                        edit: '{{ route('announcements.edit', 'null') }}',
                        show: '{{ route('announcements.show', 'null') }}',
                        destroy: '{{ route('announcements.destroy', 'null') }}',
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Feature") }}', align: 'left', value: 'feature' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Author") }}', align: 'left', value: 'user_id' },
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
                        const { sortBy, descending, announcement, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            announcement: announcement,
                            search: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.announcements.all') }}', query)
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
                    const { sortBy, descending, announcement, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        announcement: announcement,
                        sort: sortBy,
                        take: rowsPerPage,
                        search: {!! @json_encode(request()->all()) !!},
                    };
                    this.api().get('{{ route('api.announcements.all') }}', query)
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
