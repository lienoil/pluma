@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm12>

                <v-switch v-model="dataset.toggle" label="toggle view"></v-switch>
                {{-- <span v-html="dataset.items"></span> --}}

                <v-dataset
                    {{-- infinite --}}
                    :table="dataset.toggle"
                    :card="!dataset.toggle"
                    :headers="dataset.headers"
                    v-bind:pagination.sync="dataset.pagination"
                    :items="dataset.items"
                    :total-items="dataset.pagination.totalItems"
                    v-model="dataset.selected"
                    select-all="primary"
                    {{-- @infinite="listen" --}}
                    @pagination="pagination"
                >
                    <template slot="items" scope="{prop}">
                        <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                            <td>
                                <v-checkbox
                                    color="primary"
                                    hide-details
                                    :input-value="prop.selected"
                                ></v-checkbox>
                            </td>
                            <td v-html="prop.item.id"></td>
                            <td class="text-xs-center">
                                <v-avatar tile size="35px">
                                    <img :src="prop.item.thumbnail">
                                </v-avatar>
                            </td>
                            <td v-html="prop.item.name"></td>
                        </tr>
                    </template>

                    <template slot="card" scope="{prop}">
                        <v-card-media v-if="prop.thumbnail" :src="prop.thumbnail" height="250"></v-card-media>
                        <v-card-text v-html="prop.name"></v-card-text>
                        <v-card-actions class="grey--text">
                            <span v-html="prop.mimetype"></span>
                            <v-spacer></v-spacer>
                            <span v-html="prop.filesize"></span>
                        </v-card-actions>
                    </template>
                    {{-- <template slot="pagination">
                        <div class="subheading grey--text">asdas</div>
                    </template> --}}

                </v-dataset>

                {{-- <v-card tile>
                    <v-card-actions><v-icon left class="subheading">fa-flask</v-icon>Mediabox Test</v-card-actions>
                    <v-card-media height="250" :src="mediabox.selected?mediabox.selected.thumbnail:''"></v-card-media>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn primary ripple @click="mediabox.model = !mediabox.model">Open Mediabox</v-btn>
                        <v-mediabox
                            toolbar-icon="perm_media"
                            toolbar-label="Mediabox"
                            :url="mediabox.url"
                            :categories="mediabox.categories"
                            close-on-click
                            auto-remove-files
                            v-model="mediabox.model"
                            :multiple="false"
                            dropzone
                            :dropzone-options="{url:'{{ route('api.library.upload') }}', parallelUploads: mediabox.options.parrallelUploads, autoProcessQueue: true}"
                            :dropzone-params="{'_token': '{{ csrf_token() }}', 'catalogue_id': mediabox.category.id, name: mediabox.name}"
                            @upload-completed="val => mediabox.categories = []"
                            @selected="val => { mediabox.selected = val[0] }"
                            @category-change="val => mediabox.category = val"
                            @sending="({file, params}) => params.name = file.upload.filename"
                        >
                            <template slot="dropzone">
                                <span class="caption" v-if="mediabox.category">{{ __('Uploads will be catalogued as') }}<em>@{{ mediabox.category.id ? mediabox.category.name : 'Uncategorized' }}</em></span>
                                <v-card-text>
                                    <span v-if="mediabox.name" v-html="`Currently uploading ${mediabox.name}`"></span>
                                </v-card-text>
                            </template>
                        </v-mediabox>
                    </v-card-actions>
                </v-card> --}}


            </v-flex>
        </v-layout>
    </v-container>

@endsection

@push('post-css')
    {{-- <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ assets('library/vuetify-dataset/dist/vuetify-dataset.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vue-resource/dist/vue-resource.min.js') }}"></script>
    <script src="{{ assets('library/vuetify-dataset/dist/vuetify-dataset.min.js') }}"></script>
    {{-- <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script> --}}
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    mediabox: {
                        model: false,
                        url: '{{ route('api.library.all') }}',
                        categories: {!! json_encode($cataloguesObj) !!},
                        category: {},
                        selected: null,
                        name: '',
                        options: {
                            parrallelUploads: 1,
                        }
                    },

                    dataset: {
                        toggle: false,
                        headers: [
                            {text: 'ID', value: 'id', align: 'left'},
                            {text: 'Thumbnail', value: 'thumbnail', align: 'center'},
                            {text: 'Name', value: 'name', align: 'left'},
                        ],
                        counter: 2,
                        items: [],
                        selected: [],
                        totalItems: 0,
                        pagination: {
                            totalItems: 0,
                            rowsPerPage: 5,
                        }
                    }
                }
            },
            methods: {
                get (url, query) {
                    let self = this;

                    return new Promise((resolve, reject) => {
                        self.api().get(url, query).then(response => {
                            let items = response.items.data;
                            let total = response.items.total;
                            resolve({items, total})
                        });
                    });

                },
                listen ($state) {
                    let self = this;
                    // console.log('listening...')

                    if (! self.dataset.toggle) {
                        setTimeout(function () {
                            const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                            let query = {
                                descending: descending?descending:false,
                                page: self.dataset.counter,
                                sort: sortBy?sortBy:'id',
                                take: rowsPerPage?rowsPerPage:5,
                            };


                            self.get('{{ route('api.library.all') }}', query).then(response => {
                                if (self.dataset.items.length == response.total) {
                                    $state.complete();
                                    self.dataset.counter = 1;
                                } else {
                                    self.dataset.items = self.dataset.items.concat(response.items);
                                    self.dataset.pagination.totalItems = response.total;
                                    $state.loaded();
                                    self.dataset.counter++;
                                }
                            });
                        }, 1000);
                    }
                },
                getOutput (value) {
                    this.mediabox.output = value;
                },

                pagination (pagination) {
                    let self = this;
                    const { sortBy, descending, page, rowsPerPage } = pagination;
                    console.log('pagination', self.dataset.pagination);
                    let query = {
                        descending: descending?descending:false,
                        page: page,
                        sort: sortBy?sortBy:'id',
                        take: rowsPerPage,
                    };

                    self.get('{{ route('api.library.all') }}', query).then(response => {
                        self.dataset.items = response.items;
                        self.dataset.pagination.totalItems = response.total;
                        console.log('xxcad', self.dataset.pagination);
                    });
                }
            },

            watch: {
                'dataset.pagination': {
                    handler () {
                        let self = this;
                        const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                        console.log('pagination', self.dataset.pagination);
                        let query = {
                            descending: descending?descending:false,
                            page: page,
                            sort: sortBy?sortBy:'id',
                            take: rowsPerPage,
                        };

                        self.get('{{ route('api.library.all') }}', query).then(response => {
                            self.dataset.items = response.items;
                            self.dataset.pagination.totalItems = response.total;
                            console.log('xxcad', self.dataset.pagination);
                            // self.dataset.counter = page;
                        });

                    },
                    deep: true
                },

                'dataset.toggle': function (value) {
                    let self = this;

                    // if (value) {
                    //     // table
                    //     const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                    //     let query = {
                    //         descending: descending?descending:false,
                    //         page: page,
                    //         sort: sortBy?sortBy:'id',
                    //         take: rowsPerPage?rowsPerPage:5,
                    //     };

                    //     self.get('{{ route('api.library.all') }}', query).then(response => {
                    //         self.dataset.items = response.items;
                    //         self.dataset.pagination.totalItems = response.total;
                    //     });
                    // } else {
                    //     self.dataset.pagination.page = self.dataset.counter;
                    // }
                }
            },

            mounted () {
                let self = this;
                self.catalogues = JSON.parse(JSON.stringify({!! json_encode($catalogues) !!}));

                const { sortBy, descending, page, rowsPerPage } = self.dataset.pagination;
                let query = {
                    descending: descending?descending:false,
                    page: page,
                    sort: sortBy?sortBy:'id',
                    take: rowsPerPage?rowsPerPage:5,
                };
                self.get('{{ route('api.library.all') }}').then(response => {
                    self.dataset.items = response.items;
                    self.dataset.pagination.totalItems = response.total;
                });
            },
        })
    </script>
@endpush
