<v-dialog
    v-model="mediabox.model"
    fullscreen
    lazy
    transition="dialog-bottom-transition"
    hide-overlay
    @close=""
>
    <v-card flat tile class="grey lighten-4">
        <v-toolbar card dark class="accent">
            <v-progress-circular v-if="dataset.loading" indeterminate class="primary--text"></v-progress-circular>
            <v-spacer></v-spacer>
            <v-btn icon v-tooltip:left="{'html': '{{ __('Close Media') }}'}" @click.native="media().close()" dark><v-icon>close</v-icon></v-btn>
        </v-toolbar>

        @stack('mediabox.content')

        <v-tabs icons dark v-model="mediabox.tabs.active">
            <v-tabs-bar class="accent">
                <v-tabs-item
                    key="tab-all"
                    href="#tab-all"
                    ripple
                >
                    <v-icon>book</v-icon>
                    {{ __('All Library') }}
                </v-tabs-item>
                <v-tabs-item
                    :key="`tab-${tab.code}`"
                    :href="`#tab-${tab.code}`"
                    ripple
                    v-for="(tab, key) in suppliments.mediabox.tabs.items"
                >
                    <v-icon v-if="tab.icon" v-badge="{value: tab.libraries.length}">@{{ tab.icon }}</v-icon>
                    @{{ tab.name }}
                </v-tabs-item>
                <v-tabs-slider class="primary"></v-tabs-slider>
            </v-tabs-bar>

            <v-tabs-items>
                <v-tabs-content
                    id="tab-all"
                    key="tab-all"
                >
                    <v-card flat class="transparent">
                        <v-card-text>
                            {{-- Search --}}
                            <v-text-field
                                append-icon="search"
                                label="{{ _('Search') }}"
                                single-line
                                hide-details
                                v-model="dataset.searchform.query"
                                light
                            ></v-text-field>
                            {{-- <v-btn v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" icon flat light @click.native="dataset.searchform.model = !dataset.searchform.model; dataset.searchform.query = '';">
                                <v-icon>@{{ !dataset.searchform.model ? 'search' : 'clear' }}</v-icon>
                            </v-btn> --}}
                            {{-- /Search --}}
                        </v-card-text>
                    </v-card>
                    <v-card flat class="transparent">
                        <v-container fluid grid-list-lg>
                            <v-layout row wrap>
                                <template v-for="(item, m) in dataset.items">
                                    <v-flex sm3>
                                        <v-card role="button" @click="media().select(item)" :key="m" tile accent class="mb-1 elevation-1">
                                            <v-card-media ripple :src="item.thumbnail" height="250px"></v-card-media>
                                            <v-card-text class="grey--text">
                                                @{{ item.name }}
                                                <v-spacer></v-spacer>
                                                <span class="caption" v-html="item.mime"></span>
                                                <span class="caption" v-html="item.filesize"></span>
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                </template>
                            </v-layout>
                        </v-container>
                    </v-card>
                </v-tabs-content>
                <v-tabs-content
                    :id="`tab-${tab.code}`"
                    :key="`tab-${tab.code}`"
                    v-for="(tab, key) in suppliments.mediabox.tabs.items"
                >
                    <v-card flat class="transparent">
                        <v-container fluid grid-list-lg>
                            <v-layout row wrap>
                                <template v-for="(item, m) in tab.libraries">
                                    <v-flex sm3>
                                        <v-card role="button" @click="media().select(item)" :key="m" tile accent class="mb-1 elevation-1">
                                            <v-card-media ripple :src="item.thumbnail" height="250px"></v-card-media>
                                            <v-card-text>
                                                @{{ item.name }}
                                            </v-card-text>
                                            <v-card-actions class="grey--text">
                                                <v-spacer></v-spacer>
                                                <span class="caption" v-html="item.mime"></span>
                                                <span class="caption" v-html="item.filesize"></span>
                                            </v-card-actions>
                                        </v-card>
                                    </v-flex>
                                </template>
                            </v-layout>
                        </v-container>
                    </v-card>
                </v-tabs-content>
            </v-tabs-items>
        </v-tabs>

    </v-card>
</v-dialog>

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Alias") }}', align: 'left', value: 'alias' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Last Modified") }}', align: 'left', value: 'updated_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false, value: 'updated_at' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 10,
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                    mediabox: {
                        loading: true,
                        model: false,
                        value: null,
                        origin: null,
                        tabs: {
                            active: '',
                        }
                    },

                    suppliments: {
                        mediabox: {
                            tabs: {
                                items: [],
                            },
                        },
                    },
                };
            },

            watch: {
                'dataset.searchform.query': function (filter) {
                    this.dataset.loading = true;
                    setTimeout(() => {
                        const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending?descending:true,
                            page: page?page:1,
                            q: filter,
                            sort: sortBy?sortBy:'name',
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.library.search') }}', query)
                            .then((data) => {
                                this.dataset.items = data.items.data ? data.items.data : data.items;
                                this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                                this.dataset.loading = false;
                            });
                    }, 1000);
                },
            },

            methods: {
                media (origin, options) {
                    origin = origin || null;
                    options = options || {};
                    let self = this;

                    return {
                        open () {
                            self.$emit("mediabox.open", origin, options);
                            self.mediabox.origin = origin;
                            self.mediabox.model = true;
                        },

                        select (selected) {
                            self.$emit("mediabox.select", selected, self.mediabox.origin, options);
                            self.mediabox.value = {item: selected, origin: self.mediabox.origin};
                        },

                        toggle () {
                            self.$emit("mediabox.toggle", origin, options);
                            self.mediabox.model = ! self.mediabox.model;
                        },

                        close () {
                            self.$emit("mediabox.close", origin, options);
                            self.mediabox.model = false;
                        },
                    };
                },

                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending?descending:true,
                        page: page?page:1,
                        sort: sortBy?sortBy:'name',
                        take: rowsPerPage,
                    };

                    this.api().get('{{ route('api.library.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                            this.mountSuppliments();
                        });
                },

                mountSuppliments () {
                    this.api().get('{{ route('api.library.catalogues') }}')
                        .then((data) => {
                            this.suppliments.mediabox.tabs.items = data.items.data ? data.items.data : data.items;
                        });

                },
            },

            mounted () {
                this.get();
                this.mountSuppliments();
            }
        });
    </script>
@endpush
