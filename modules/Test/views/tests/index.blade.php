@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")
        <v-layout row wrap>
            <v-flex sm12>
                <v-card class="elevation-1">
                    <v-card-title class="headline">Test Module</v-card-title>
                    <v-card-text>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum cupiditate tenetur ut dolorum soluta sit pariatur cum repellat velit officiis, nobis, maiores, quo asperiores id ipsa. Laudantium quas in quae.</p>
                    </v-card-text>
                    <v-btn @click="mediabox.model = true">Mediabox</v-btn>
                    <v-mediabox search :multiple="false" close-on-click v-model="mediabox.model" :categories="catalogues" v-model="mediabox.model" :selected="mediabox.output" @selected="getOutput">
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
                </v-card>

                {{-- <v-span v-html="mediabox.output"></v-span> --}}
                <v-scale-transition>
                    <v-card class="mt-3" v-show="mediabox.output.length" :key="i" v-for="(o, i) in mediabox.output" @click.stop="mediabox.model = true" role="button">
                        <v-card-media :src="o.thumbnail" height="250px">
                            <v-container fill-height fluid class="pa-0 white--text">
                              <v-layout column>
                                <v-card-title class="subheading">
                                    <div v-html="o.originalname"></div>
                                    <v-spacer></v-spacer>
                                    <v-btn dark icon @click.stop="mediabox.output = []"><v-icon>close</v-icon></v-btn>
                                </v-card-title>
                                <v-spacer></v-spacer>
                                <v-card-actions class="px-2 white--text">
                                  <v-icon class="white--text" v-html="o.icon"></v-icon>
                                  <v-spacer></v-spacer>
                                  <span v-html="o.mime"></span>
                                  <span v-html="o.filesize"></span>
                                </v-card-actions>
                              </v-layout>
                            </v-container>
                        </v-card-media>
                    </v-card>
                </v-scale-transition>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('test/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    catalogues: JSON.parse(JSON.stringify({!! json_encode($catalogues) !!})),
                    mediabox: {
                        model: false,
                        output: []
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
                    console.log("OUTPUR", val);
                }
            },

            mounted () {
                this.catalogues = JSON.parse(JSON.stringify({!! json_encode($catalogues) !!}));
                console.log(this.catalogues);
            }
        })
    </script>
@endpush
