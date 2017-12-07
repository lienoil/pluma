@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid class="pa-0">
        <v-flex sm12 class="pa-4">
            <p class="grey--text">Lorem ipsum dolor sit.</p>
            <p class="subheading">Test for Project-in-Project (PiP) approach</p>
            <p>Page starts after horizontal line.</p>
        </v-flex>
        <v-divider class="mb-4"></v-divider>

        <v-container fluid>
            <v-flex sm12>
                {{-- Editor --}}
                <v-quill class="elevation-0" source :upload-params="{_token: '{{ csrf_token() }}', 'return': 1}" :options="{urlPrefix: '{{ url('storage') }}/', uploadUrl: '{{ route('api.library.upload') }}', placeholder: '{{ __('Write something...') }}'}" v-model="resource.quill" class="mb-3 card--flat white elevation-1" :fonts="['Default', 'Ubuntu', 'Roboto']" @mediabox="mediaboxbox">
                    <template>
                        <input type="hidden" name="body" :value="resource.quill.html">
                        <input type="hidden" name="delta" :value="JSON.stringify(resource.quill.delta)">
                    </template>
                </v-quill>
                {{-- /Editor --}}

                <v-btn @click="mediabox.model = !mediabox.model">asd</v-btn>
                <v-mediabox :multiple="false" close-on-click :categories="mediabox.catalogues" v-model="mediabox.model" @selected="value => { mediabox.resource = value }">
                    <template slot="media" scope="props">
                        <v-card transition="scale-transition" class="accent" :class="props.item.active?'elevation-10':'elevation-1'">
                            {{-- <span v-html="props"></span> --}}
                            <v-card-media height="250px" :src="props.item.thumbnail">
                                <v-container fill-height class="pa-0 white--text">
                                    <v-layout fill-height wrap column>
                                        <v-card-title class="subheading" v-html="props.item.originalname"></v-card-title>
                                        <v-slide-y-transition>
                                            <v-icon ripple class="display-4 pa-1 text-xs-center white--text" v-show="props.item.active">check</v-icon>
                                        </v-slide-y-transition>
                                        <v-spacer></v-spacer>
                                        <v-card-actions class="px-2 white--text">
                                            <v-icon class="white--text" v-html="props.item.icon"></v-icon>
                                            <v-spacer></v-spacer>
                                            <span v-html="props.item.mime"></span>
                                            <span v-html="props.item.filesize"></span>
                                        </v-card-actions>
                                    </v-layout>
                                </v-container>
                            </v-card-media>
                        </v-card>
                    </template>
                </v-mediabox>

            </v-flex>
        </v-container>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css?v='.date('H_i_s')) }}">
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css?v='.date('H_i_s')) }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js?v='.date('H_i_s')) }}"></script>
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js?v='.date('H_i_s')) }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                        quill: {delta: '', html: ''}
                    },
                    mediabox: {
                        catalogues: {!! json_encode($catalogues) !!},
                        model: false,
                        resource: {},
                    },
                }
            },
            methods: {
                mediaboxbox (quill) {
                    this.mediabox.model = !this.mediabox.model;
                    // console.log(quill)
                    console.log(this.mediabox.catalogues)
                }
            }
        })
    </script>
@endpush
