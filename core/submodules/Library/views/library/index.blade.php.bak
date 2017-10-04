@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid class="grey lighten-4" grid-list-lg>

        <v-slide-y-transition>
            <v-layout v-if="bulk.upload.model" row wrap>
                <v-flex>
                    @include("Theme::cards.upload")
                </v-flex>
            </v-layout>
        </v-slide-y-transition>

        <v-layout fill-height row wrap>
            <v-flex fill-height md3>
                <v-list dense class="grey lighten-4">
                    <v-subheader>{{ __('Catalogues') }}</v-subheader>

                    <v-divider class="my-1"></v-divider>

                    <v-list-tile href="{{ route('library.index') }}" :class="!suppliments.catalogues.current ? 'active--primary' : ''">
                        <v-list-tile-action>
                            <v-icon :class="!suppliments.catalogues.current ? 'white--text' : 'grey--text'">book</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content :class="!suppliments.catalogues.current ? 'white--text' : 'grey--text'">
                            <v-list-tile-title>{{ __('All') }}</v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <span class="grey--text">@{{ dataset.items.length }}</span>
                        </v-list-tile-action>
                    </v-list-tile>

                    <v-divider class="my-1"></v-divider>

                    <v-list-tile :href="route(urls.library.index, {catalogue: catalogue.id})" v-for="(catalogue, key) in suppliments.catalogues.items" :key="key" :class="catalogue.active ? 'active--primary' : ''">
                        <v-list-tile-action>
                            <v-icon :class="catalogue.active ? 'white--text' : 'grey--text'">@{{ catalogue.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content :class="catalogue.active ? 'white--text' : 'grey--text'">
                            <v-list-tile-title>@{{ catalogue.name }}</v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <span class="grey--text">@{{ catalogue.libraries.length }}</span>
                        </v-list-tile-action>
                    </v-list-tile>

                    <div class="mt-2">
                        <v-icon>add</v-icon>
                        <a href="{{ route('catalogues.index') }}">
                            <small>{{ __('Add new catalogue') }}</small>
                        </a>
                    </div>
                </v-list>
            </v-flex>

            <v-flex md9>
                <v-toolbar flat dense class="transparent">
                    <v-spacer></v-spacer>
                    <v-btn icon><v-icon>sort</v-icon></v-btn>
                    <v-btn icon><v-icon>search</v-icon></v-btn>
                    <v-btn icon :class="bulk.upload.model ? 'btn--active primary' : ''" @click.native.stop="setStorage('bulk.upload.model', (bulk.upload.model = !bulk.upload.model))"><v-icon>fa-cloud-upload</v-icon></v-btn>
                </v-toolbar>

                <v-layout row wrap>
                    <v-flex sm4 v-for="(dataset, key) in dataset.items" :key="key">
                        <v-card tile class="elevation-1">
                            <v-card-media height="250px" :src="dataset.thumbnail">
                                <v-card-title class="subheading accent white--text" :href="dataset.thumbnail" v-html="dataset.originalname"></v-card-title>
                                <v-card-actions dense class="transparent">
                                    <v-spacer></v-spacer>
                                    <span class="caption pa-1 pink white--text" v-html="dataset.mime"></span>
                                    <span class="caption pa-1 blue white--text" v-html="dataset.filesize"></span>
                                </v-card-actions>
                            </v-card-media>
                        </v-card>
                    </v-flex>
                </v-layout>

            </v-flex>

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
                        upload: {
                            model: false,
                        },
                    },
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
                    suppliments: {
                        catalogues: {
                            current: null,
                            items: [],
                        }
                    },

                    urls: {
                        library: {
                            index: '{{ route('library.index') }}',
                        },
                    },
                };
            },

            methods: {
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
                    this.suppliments.catalogues.current = '{{ request()->getQueryString() }}';

                    this.api().get('{{ route('api.library.catalogues') }}')
                        .then((data) => {
                            console.log(data);
                            this.suppliments.catalogues.items = data.items.data ? data.items.data : data.items;
                            for (var i = this.suppliments.catalogues.items.length - 1; i >= 0; i--) {
                                let current = this.suppliments.catalogues.items[i];
                                if (current.id == this.suppliments.catalogues.current.split('=')[1]) {
                                    this.suppliments.catalogues.items[i].active = true;
                                }
                            }
                        });

                },

                storage () {
                    this.bulk.upload.model = this.getStorage('bulk.upload.model') === 'true';
                },

                complete (file, dropzone) {
                    this.get();
                },
            },

            mounted () {
                this.get();
                this.storage();
            },
        });
    </script>
@endpush
