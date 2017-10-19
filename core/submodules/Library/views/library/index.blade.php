@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar class="light-blue elevation-1 sticky" dark>

        <template v-if="dataset.searchform.model">
            <v-text-field
                prepend-icon="search"
                append-icon="close"
                :append-icon-cb="() => searchbox().close()"
                light solo hide-details single-line
                v-model="dataset.searchform.query"></v-text-field>
        </template>
        <template v-else>
            <v-menu :nudge-width="100">
                <v-toolbar-title slot="activator">
                    <v-icon class="white--text pr-2" v-html="suppliments.catalogues.current.icon">view_module</v-icon>
                    <span v-html="suppliments.catalogues.current.name"></span>
                    <v-icon dark>arrow_drop_down</v-icon>
                </v-toolbar-title>
                <v-list>
                    <v-list-tile @click="supplimentary().select(item)" ripple v-for="(item, i) in suppliments.catalogues.items" :key="i">
                        <v-list-tile-action>
                            <v-icon accent v-html="item.icon"></v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title v-html="item.name"></v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-chip class="blue white--text" label v-html="item.libraries?item.libraries.length:item.count"></v-chip>
                        </v-list-tile-action>
                    </v-list-tile>
                </v-list>
            </v-menu>

            <v-spacer></v-spacer>
            <span class="caption" v-if="bulk.selection.model" v-html="`${dataset.selected.length}/${dataset.pagination.totalItems} Selected`"></span>
            <v-spacer v-if="bulk.selection.model"></v-spacer>

            {{-- Search --}}
            <v-btn
                icon
                v-tooltip:left="{ html: 'Search' }"
                @click="dataset.searchform.model = !dataset.searchform.model"
            >
                <v-icon>search</v-icon>
            </v-btn>
            {{-- /Search --}}
        </template>

        {{-- Selection --}}
        <v-btn v-model="bulk.selection.model" :class="{'primary': bulk.selection.model}" ripple @click="bulk.selection.model = !bulk.selection.model; bulk.selection.model?bulk.toggle.model = true : null" icon v-tooltip:left="{ html: 'Toggle Bulk Selection' }">
            <v-icon>check_circle</v-icon>
        </v-btn>
        <template v-if="bulk.selection.model && dataset.selected.length > 1">
            <v-btn small icon v-tooltip:left="{html:'{{ __('Move to Trash') }}'}"><v-icon class="error--text">delete</v-icon></v-btn>
            <v-btn small icon v-tooltip:left="{html:'{{ __('Download') }}'}"><v-icon>cloud_download</v-icon></v-btn>
        </template>
        {{-- /Selection --}}

        <v-btn icon v-tooltip:left="{ html: 'Upload files' }" :class="bulk.upload.model ? 'btn--active primary' : ''" @click.native.stop="setStorage('bulk.upload.model', (bulk.upload.model = !bulk.upload.model))">
            <v-icon>fa-cloud-upload</v-icon>
        </v-btn>

        <v-btn icon v-tooltip:left="{html: 'Grid / List'}" @click="bulk.toggle.model = !bulk.toggle.model">
            <v-icon small v-if="bulk.toggle.model">view_module</v-icon>
            <v-icon small v-else>fa-list</v-icon>
        </v-btn>
        <v-btn icon v-tooltip:left="{html: 'Filter'}">
            <v-icon>filter_list</v-icon>
        </v-btn>
    </v-toolbar>

    <v-slide-y-transition>
        <v-card flat tile v-show="bulk.upload.model" class="grey lighten-4">
            <v-dropzone
                :options="{url: '{{ route('api.library.upload') }}', timeout: '120s', autoProcessQueue: true, parallelUploads: 1 }"
                :params="dropzone.params"
                auto-remove-files
                @complete="dropzonebox().completed($event)"
                @sending="dropzonebox().sending($event)"
            >
                <template>
                    <div class="caption grey--text text--darken-2">
                        <span>{{ __('You may drag 20 files at a time.') }}</span>
                        <em class="caption" v-html="`{{ __('Uploads will be catalogued as') }} <strong>${suppliments.catalogues.current.name}</strong>`"></em>
                    </div>
                </template>
            </v-dropzone>
        </v-card>
    </v-slide-y-transition>

    <v-container fluid v-if="dataset.loading">
        <v-layout fill-height row wrap>
            <v-flex xs12 class="text-xs-center">
                <v-progress-circular :size="75" indeterminate class="grey--text"></v-progress-circular>
            </v-flex>
        </v-layout>
    </v-container>

    <v-container fluid class="grey lighten-4" grid-list-lg v-if="!dataset.items.length && !bulk.upload.model">
        <v-layout fill-height row wrap>
            <v-flex xs12>
                <div class="text-xs-center grey--text">
                    <v-icon class="display-4 grey--text">fa-frown-o</v-icon>
                    <div class="mb-3">{{ __('There seems to be only loneliness here.') }}</div>
                    <div><v-btn info class="elevation-1" @click="bulk.upload.model = !bulk.upload.model">{{ __('Upload') }}</v-btn></div>
                </div>
            </v-flex>
        </v-layout>
    </v-container>

    <v-container fluid class="grey lighten-4" grid-list-lg>
        <v-layout fill-height row wrap>
            <v-flex sm12>
                <v-dataset
                    :card="!bulk.toggle.model"
                    :headers="dataset.headers"
                    :items="dataset.items"
                    :total-items="dataset.pagination.totalItems"
                    :pagination.sync="dataset.pagination"
                    :table="bulk.toggle.model"
                    item-key="id"
                    item-name="name"
                    v-model="dataset.selected"
                    v-bind="bulk.selection.model?{'select-all':'primary'}:null"
                    @pagination="datasetbox().pagination($event)"
                >
                    <template slot="items" scope="{prop}">
                        <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                            <td v-if="bulk.selection.model">
                                <v-checkbox
                                    color="primary"
                                    primary
                                    hide-details
                                    :input-value="prop.selected"
                                ></v-checkbox>
                            </td>
                            <td v-html="prop.item.id"></td>
                            <td>
                                <v-avatar size="35px">
                                    <img :src="prop.item.thumbnail">
                                </v-avatar>
                                <span v-html="prop.item.name"></span>
                            </td>
                            <td><v-chip class="red lighten-3 white--text"><v-icon left class="white--text" v-html="prop.item.icon"></v-icon><span v-html="prop.item.mimetype"></span></v-chip></td>
                            <td v-html="prop.item.filesize"></td>
                            <td v-html="prop.item.created"></td>
                            <td v-html="prop.item.modified"></td>
                        </tr>
                    </template>
                    <template slot="card" scope="{prop}">
                        <v-card-media height="250px" :src="prop.item.thumbnail" class="grey lighten-4">
                            <v-container fill-height class="pa-0 white--text">
                                <v-layout fill-height wrap column>
                                    {{-- <v-scale-transition>
                                        <v-btn v-show="bulk.selection.model" icon small class="white success--text" ripple @click.stop="prop.selected = !prop.selected">
                                            <v-icon v-if="prop.selected" ripple small class="success--text">check_circle</v-icon>
                                            <v-icon v-else ripple small class="success--text">radio_button_unchecked</v-icon>
                                        </v-btn>
                                    </v-scale-transition> --}}
                                    <v-spacer></v-spacer>
                                </v-layout>
                            </v-container>
                        </v-card-media>
                        <v-divider></v-divider>
                        <v-toolbar card dense class="transparent">
                            <v-toolbar-title class="subheading" v-html="prop.item.name"></v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-btn small absolute fab top right class="info darken-1 elevation-1"><v-icon class="white--text" v-html="prop.item.icon"></v-icon></v-btn>
                        </v-toolbar>
                        <v-card-actions class="grey--text px-2">
                            <span class="caption" v-html="prop.item.mimetype"></span>
                            <v-spacer></v-spacer>
                            <span class="caption" v-html="prop.item.filesize"></span>
                        </v-card-actions>
                    </template>
                </v-dataset>
            </v-flex>
            {{-- <v-flex fill-height md3 v-for="(item, i) in dataset.items" :key="i">
                <v-card tile class="elevation-1" @click.stop="item.active = !item.active">
                    <v-card-media height="250px" :src="item.thumbnail" class="grey lighten-4">
                        <v-container fill-height class="pa-0 white--text">
                            <v-layout fill-height wrap column>
                                <v-scale-transition>
                                    <v-btn v-show="bulk.selection.model" icon small class="white success--text" ripple @click.stop="item.active = !item.active">
                                        <v-icon v-if="!item.active" ripple small class="success--text">radio_button_unchecked</v-icon>
                                        <v-icon v-else ripple small class="success--text">check_circle</v-icon>
                                    </v-btn>
                                </v-scale-transition>
                                <v-spacer></v-spacer>
                                <v-card-actions class="px-2 white--text">
                                </v-card-actions>
                            </v-layout>
                        </v-container>
                    </v-card-media>
                    <v-toolbar card dense class="transparent">
                        <v-toolbar-title class="subheading" v-html="item.name"></v-toolbar-title>

                        <v-spacer></v-spacer>
                        <v-btn small absolute fab top right class="info darken-1 elevation-1"><v-icon class="white--text" v-html="item.icon"></v-icon></v-btn>
                    </v-toolbar>
                    <v-card-actions class="grey--text px-2">
                        <span class="caption" v-html="item.mimetype"></span>
                        <v-spacer></v-spacer>
                        <span class="caption" v-html="item.filesize"></span>
                    </v-card-actions>
                </v-card>
            </v-flex> --}}
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ 'http://localhost:8080/dist/vuetify-dataset.min.css' }}">
    <link rel="stylesheet" href="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ 'http://localhost:8080/dist/vuetify-dataset.min.js' }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        upload: {
                            model: false,
                        },
                        toggle: {
                            model: false,
                        },
                        selection: {
                            model: false,
                        },
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            // { text: '{{ __("Thumbnail") }}', align: 'left', value: 'thumbnail' },
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("File Type") }}', align: 'left', value: 'mimetype' },
                            { text: '{{ __("File Size") }}', align: 'left', value: 'size' },
                            { text: '{{ __("Uploaded") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
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
                    },
                    suppliments: {
                        catalogues: {
                            current: {},
                            items: [],
                        }
                    },

                    urls: {
                        library: {
                            catalogue: '{{ route('api.library.catalogue', 'null') }}',
                            index: '{{ route('library.index') }}',
                        },
                    },

                    dropzone: {
                        currentfile: {},
                        params: {
                            _token: '{{ csrf_token() }}',
                        },
                    }
                };
            },

            watch: {
                'dataset.searchform.query': function (q) {
                    // console.log('se', q)
                    this.search('{{ route('api.library.search') }}', q)
                }
            },

            methods: {
                search (url, q) {
                    let self = this;

                    setTimeout(function () {
                        self.dataset.loading = true

                        const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                        let query = {
                            descending: descending?descending:true,
                            page: page?page:1,
                            sort: sortBy?sortBy:'id',
                            take: rowsPerPage,
                            _token: '{{ csrf_token() }}',
                            q: q
                        };

                        self.api().search(url, query)
                            .then((data) => {
                                self.dataset.items = data.items.data ? data.items.data : data.items;
                                self.dataset.pagination.totalItems = data.items.total ? data.items.total : data.total;
                                self.dataset.loading = false;
                                self.dataset.items.map(item => {
                                    self.$set(item, 'active', false);
                                });
                                self.dataset.loading = false;
                                // console.log('searc',self.dataset)
                            });
                    }, 1000)
                },
                get (url, query) {
                    let self = this;
                    // self.dataset.loading = true;

                    if (! query) {
                        const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                        let query = {
                            descending: descending?descending:true,
                            page: page?page:1,
                            sort: sortBy?sortBy:'id',
                            take: rowsPerPage,
                            _token: '{{ csrf_token() }}'
                        };
                    }

                    self.api().get(url, query)
                        .then((data) => {
                            self.dataset.items = data.items.data ? data.items.data : data.items;
                            self.dataset.pagination.totalItems = data.items.total ? data.items.total : data.total;
                            self.dataset.loading = false;
                            self.dataset.items.map(item => {
                                self.$set(item, 'active', false);
                            });
                            self.mountSuppliments();
                            // self.dataset.loading = false;
                            // console.log(self.dataset)
                        });
                },

                mountSuppliments () {
                    // this.suppliments.catalogues.current = '{{ request()->getQueryString() }}';

                    // this.api().get('{{ route('api.library.catalogues') }}')
                    //     .then((data) => {
                    //         console.log(data);
                    //         this.suppliments.catalogues.items = data.items.data ? data.items.data : data.items;
                    //         for (var i = this.suppliments.catalogues.items.length - 1; i >= 0; i--) {
                    //             let current = this.suppliments.catalogues.items[i];
                    //             if (current.id == this.suppliments.catalogues.current.split('=')[1]) {
                    //                 this.suppliments.catalogues.items[i].active = true;
                    //             }
                    //         }
                    //     });

                },

                storage () {
                    // this.bulk.upload.model = this.getStorage('bulk.upload.model') === 'true';
                },

                complete (file, dropzone) {
                    this.get('{{ route('api.library.all') }}');
                },

                supplimentary () {
                    let self = this;

                    return {
                        mount (items) {
                            self.suppliments.catalogues.items.push({name:'{{ __('All') }}', code: 'all', icon: 'perm_media', count: '{{ $resources->count() }}'});

                            for (var i = 0; i < items.length; i++) {
                                items[i].count = items[i].count ? items[i].count : items[i].libraries.length;
                                self.suppliments.catalogues.items.push(items[i]);
                            }

                            self.suppliments.catalogues.current = self.suppliments.catalogues.items[0];
                        },

                        select (item) {
                            self.suppliments.catalogues.current = item;

                            if (item.id) {
                                self.get(self.route(self.urls.library.catalogue, item.id));
                            } else {
                                self.get('{{ route('api.library.all') }}');
                            }
                        }
                    }
                },

                datasetbox () {
                    let self = this
                    return {
                        pagination (pagination) {
                            const { sortBy, descending, page, rowsPerPage } = pagination;
                            console.log('pagination', self.dataset.pagination);
                            let query = {
                                descending: descending?descending:false,
                                page: page,
                                sort: sortBy?sortBy:'id',
                                take: rowsPerPage,
                            };

                            self.get('{{ route('api.library.all') }}', query);
                        }
                    }
                },

                searchbox () {
                    let self = this

                    return {
                        close () {
                            self.dataset.searchform.model = !self.dataset.searchform.model

                            if (! self.dataset.searchform.model) {
                                self.supplimentary().select(self.suppliments.catalogues.current);
                            }
                        }
                    }
                },

                dropzonebox () {
                    let self = this
                    return {
                        completed (file) {
                            self.supplimentary().select(self.suppliments.catalogues.current);
                        },

                        sending ({file, xhr, formData}) {
                            self.dropzone.params.originalname = file.upload.filename;
                            self.dropzone.params.catalogue_id = self.suppliments.catalogues.current.id ? self.suppliments.catalogues.current.id : 0;
                        },
                    }
                }
            },

            mounted () {
                this.get('{{ route('api.library.all') }}');
                this.storage();
                this.supplimentary().mount({!! json_encode($catalogues) !!});
            },
        });
    </script>
@endpush
