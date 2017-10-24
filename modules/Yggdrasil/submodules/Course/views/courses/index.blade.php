@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar dark class="mb-3 elevation-1 info sticky">
        <v-menu transition="slide-y-transition">
            <v-btn flat slot="activator" class="white--text">
                <v-icon left>perm_media</v-icon>
                <span>All</span>
                <v-icon right>arrow_drop_down</v-icon>
            </v-btn>
        </v-menu>

        <v-spacer></v-spacer>
        <template>
            <v-text-field
                :append-icon-cb="() => {bulk.searchform.model = !bulk.searchform.model}"
                :prefix="bulk.searchform.prefix"
                :prepend-icon="bulk.searchform.prepend"
                append-icon="search"
                light solo hide-details single-line
                placeholder="Search"
                v-model="bulk.searchform.query"
                v-show="bulk.searchform.model"
            ></v-text-field>
            <v-btn v-show="!bulk.searchform.model" icon v-tooltip:left="{html:'{{ __('Search') }}'}" @click.stop="bulk.searchform.model = !bulk.searchform.model"><v-icon>search</v-icon></v-btn>
        </template>
        <v-btn icon v-tooltip:left="{html:'{{ __('Sort') }}'}"><v-icon>sort</v-icon></v-btn>
        <v-btn icon v-tooltip:left="{html:bulk.gridlist.model?'{{ __('Grid View') }}':'{{ __('List View') }}'}" @click.stop="bulk.gridlist.model = !bulk.gridlist.model"><v-icon v-html="bulk.gridlist.model?'apps':'list'"></v-icon></v-btn>
        <v-btn icon v-tooltip:left="{html:'{{ __('Filter') }}'}"><v-icon>fa-filter</v-icon></v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>

            <template>
                <v-flex
                    md4
                    v-for="(card, i) in dataset.items"
                    :key="card.id">
                    <v-card class="elevation-1">
                        <v-card-media :src="card.backdrop" height="250px">
                            <v-container fill-height fluid class="pa-0 white--text">
                                <v-layout column>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn dark icon><v-icon>more_vert</v-icon></v-btn>
                                    </v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-card-actions>
                                        {{-- If Bookmarked --}}
                                        <v-avatar small v-if="true" class="red darken-1" v-tooltip:right="{html:'{{ __('Bookmarked') }}'}"><v-icon small class="white--text">fa-bookmark</v-icon></v-avatar>
                                        {{-- /If Bookmarked --}}
                                        <v-spacer></v-spacer>
                                        {{-- If Enrolled --}}
                                        <v-chip small class="ml-0 green white--text">{{ __('Enrolled') }}</v-chip>
                                        {{-- /If Enrolled --}}
                                    </v-card-actions>
                                </v-layout>
                            </v-container>
                        </v-card-media>

                        <v-card-title primary-title>
                            <strong class="title td-n accent--text" v-html="card.title"></strong>
                        </v-card-title>

                        <v-card-actions class="transparent">
                            <v-chip label small class="pl-1 caption transparent grey--text elevation-0"><v-icon left small class="subheading">class</v-icon><span v-html="card.code"></span></v-chip>

                            <v-chip label small class="pl-1 caption transparent grey--text elevation-0"><v-icon left small class="subheading">fa-tasks</v-icon>&nbsp;<span v-html="`${card.lessons.length} Parts`"></span></v-chip>

                            <v-chip v-if="card.category" label class="pl-1 caption transparent grey--text elevation-0"><v-icon left small class="subheading">label</v-icon><span v-html="card.category.name"></span></v-chip>

                            <v-chip label small class="pl-1 caption transparent grey--text elevation-0"><v-icon left small class="subheading">fa-clock-o</v-icon><span v-html="card.created"></span></v-chip>
                        </v-card-actions>

                        <v-card-text class="grey--text text--darken-1" v-html="card.excerpt"></v-card-text>


                        <v-card-actions>
                            <v-spacer></v-spacer>

                            @can('show-course')
                            <v-btn flat primary :href="route(urls.show, card.slug)">{{ __('Learn More') }}</v-btn>
                            @endcan

                            @can('edit-course')
                            <v-btn flat success :href="route(urls.edit, card.id)">{{ __('Edit') }}</v-btn>
                            @endcan
                        </v-card-actions>
                    </v-card>
                </v-flex>
            </template>

        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        destroy: {
                            model: false,
                        },
                        gridlist: {
                            model: true,
                        },
                        searchform: {
                            model: false,
                        },
                    },
                    urls: {
                        show: '{{ route('courses.show', 'null') }}',
                        edit: '{{ route('courses.edit', 'null') }}',
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Alias") }}', align: 'left', value: 'alias' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Grants") }}', align: 'left', value: 'grants' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 10,
                            totalItems: 0,
                            page: 1,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                }
            },
            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending ? descending : null,
                        page: page,
                        sort: sortBy ? sortBy : null,
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.courses.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                this.get();
            },
        })
    </script>
@endpush
