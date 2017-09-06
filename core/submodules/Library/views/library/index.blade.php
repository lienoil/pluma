@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid class="grey lighten-4" grid-list-lg>
        <v-layout fill-height row wrap>
            <v-flex fill-height md3>
                <v-list dense class="grey lighten-4">
                    <v-subheader>{{ __('Catalogues') }}</v-subheader>
                    <v-divider></v-divider>
                    <v-list-tile :href="route(urls.library.index, {catalogue: catalogue.id})" v-for="(catalogue, key) in suppliments.catalogues.items" :key="key">
                        <v-list-tile-action>
                            <v-icon>@{{ catalogue.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content class="grey--text">
                            <v-list-tile-title>@{{ catalogue.name }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </v-list>
            </v-flex>

            <v-flex md9>
                <v-toolbar flat dense class="transparent">
                    <v-subheader>{{ __('Collection') }}</v-subheader>
                    <v-spacer></v-spacer>
                    <v-btn icon><v-icon>sort</v-icon></v-btn>
                    <v-btn icon><v-icon>search</v-icon></v-btn>
                    <v-btn icon @click.native.stop="bulk.upload.model = !bulk.upload.model"><v-icon>fa-cloud-upload</v-icon></v-btn>
                </v-toolbar>

                        <dropzone id="myVueDropzone">
                            <!-- Optional parameters if any! -->
                            <input type="hidden" name="token" value="xxx">
                        </dropzone>
                <v-slide-y-transition>
                    <div v-if="bulk.upload.model">
                    </div>
                </v-slide-y-transition>

                <v-layout row wrap>
                    @foreach ($resources as $resource)
                        <v-flex sm4>
                            <v-card tile class="elevation-1">
                                {{-- <v-card-media height="200px" src="//source.unplash.com/100x100?nature"></v-card-media> --}}
                                <v-card-title>{{ $resource->name }}</v-card-title>
                            </v-card>
                        </v-flex>
                    @endforeach
                </v-layout>

            </v-flex>

        </v-layout>
    </v-container>

@endsection

@push('post-css')
    <link rel="stylesheet" href="{{ assets('frontier/components/dropzone/dist/dropzone.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/components/dropzone/dist/dropzone.js') }}"></script>
    <script>
        Vue.use(VueResource);
        Vue.use(dropzone);

        mixins.push({
            components: {dropzone},
            data () {
                return {
                    bulk: {
                        upload: {
                            model: false,
                        },
                    },
                    suppliments: {
                        catalogues: {
                            items: {!! json_encode($catalogues->toArray()) !!},
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
                showSuccess: function (file) {
                    console.log('A file was successfully uploaded');
                },
            },
        });
    </script>
@endpush
