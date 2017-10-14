@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar class="light-blue elevation-1" dark>
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

        <v-btn icon v-tooltip:left="{ html: 'Search' }">
            <v-icon>search</v-icon>
        </v-btn>
        <v-btn icon v-tooltip:left="{ html: 'Upload files' }" :class="bulk.upload.model ? 'btn--active primary' : ''" @click.native.stop="setStorage('bulk.upload.model', (bulk.upload.model = !bulk.upload.model))">
            <v-icon>fa-cloud-upload</v-icon>
        </v-btn>
        <v-btn icon v-tooltip:left="{ html: 'Sort' }">
            <v-icon>sort</v-icon>
        </v-btn>
        <v-btn icon id="Button1" v-tooltip:left="{ html: 'Grid / List' }">
            <v-icon>view_module</v-icon>
        </v-btn>
        <v-btn icon v-tooltip:left="{ html: 'Filter' }">
            <v-icon>filter_list</v-icon>
        </v-btn>
        <v-menu bottom left>
            <v-btn icon class="white--text" slot="activator" v-tooltip:bottom="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
            <v-list>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon accent class="blue--text">select_all</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            Select
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon accent>mode_edit</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            Edit
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile>
                    <v-list-tile-action>
                        <v-icon accent class="orange--text">delete</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            Move to Trash
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
            </v-list>
        </v-menu>
    </v-toolbar>

    <v-container fluid class="grey lighten-4" grid-list-lg>
        <v-layout fill-height row wrap>
            <v-flex fill-height md3 v-for="(item, i) in dataset.items" :key="i">
                <v-card class="elevation-1">
                    <v-card-media height="250px" :src="item.thumbnail">
                        <v-container fill-height class="pa-0 white--text">
                            <v-layout fill-height wrap column>
                                <v-slide-y-transition>
                                    <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="item.active">check</v-icon>
                                </v-slide-y-transition>
                                <v-spacer></v-spacer>
                                <v-card-actions class="px-2 white--text">
                                    {{-- <span v-html="item.mimetype"></span>
                                    <span v-html="item.filesize"></span> --}}
                                </v-card-actions>
                            </v-layout>
                        </v-container>
                    </v-card-media>
                    <v-toolbar card>
                        <v-toolbar-title class="subheading" v-html="item.originalname"></v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn small absolute fab top right class="info darken-1 elevation-1"><v-icon class="white--text" v-html="item.icon"></v-icon></v-btn>
                    </v-toolbar>
                </v-card>
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
                            current: {},
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
                    this.bulk.upload.model = this.getStorage('bulk.upload.model') === 'true';
                },

                complete (file, dropzone) {
                    this.get();
                },

                supplimentary () {
                    let self = this;

                    return {
                        mount () {
                            self.suppliments.catalogues.items.push({name:'{{ __('All') }}', icon: 'perm_media', count: '{{ $resources->count() }}'});
                            let items = {!! json_encode($catalogues) !!};

                            for (var i = 0; i < items.length; i++) {
                                self.suppliments.catalogues.items.push(items[i]);
                            }

                            self.suppliments.catalogues.current = self.suppliments.catalogues.items[0];
                        },

                        select (item) {
                            self.suppliments.catalogues.current = item;
                        }
                    }
                }
            },

            mounted () {
                this.get();
                this.storage();
                this.supplimentary().mount();
            },
        });
    </script>
@endpush
