@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm6>

                <v-card tile>
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

                                {{-- <v-divider></v-divider> --}}
                                <v-card-text>
                                    <span v-if="mediabox.name" v-html="`Currently uploading ${mediabox.name}`"></span>
                                </v-card-text>
                            </template>
                        </v-mediabox>
                    </v-card-actions>
                </v-card>


            </v-flex>
        </v-layout>
    </v-container>

@endsection

@push('post-css')
    {{-- <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}"> --}}
    <link rel="stylesheet" href="http://localhost:8080/dist/vuetify-mediabox.min.css">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vue-resource/dist/vue-resource.min.js') }}"></script>
    <script src="http://localhost:8080/dist/vuetify-mediabox.min.js"></script>
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
                    }
                }
            },
            methods: {
                getOutput (value) {
                    this.mediabox.output = value;
                }
            },
            watch: {
                'catalogues': function (val) {
                    //
                },
                'mediabox.output': function (val) {
                    // console.log("OUTPUR", val);
                }
            },

            mounted () {
                this.catalogues = JSON.parse(JSON.stringify({!! json_encode($catalogues) !!}));
                // console.log(this.catalogues);
            }
        })
    </script>
@endpush
