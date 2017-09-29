@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")
        <v-layout row wrap>
            <v-flex sm12>
                <v-tabs dark v-model="tab">
                  <v-tabs-bar class="accent white--text">
                    <v-tabs-item
                      v-for="tab in 5"
                      :key="`tab-${tab}`"
                      :href="'#tab-' + tab"
                      ripple
                    >
                      Item @{{ tab }}
                    </v-tabs-item>
                    <v-tabs-slider class="primary"></v-tabs-slider>
                  </v-tabs-bar>
                  <v-tabs-items>
                    <v-tabs-content
                      v-for="tab in 5"
                      :key="`tab-${tab}`"
                      :id="`tab-${tab}`"
                    >
                      <v-card flat>
                        <v-card-text>lorem @{{ tab }}</v-card-text>
                      </v-card>
                    </v-tabs-content>
                  </v-tabs-items>
                </v-tabs>

                <v-divider></v-divider>

                <v-card class="elevation-1">
                    <v-card-title class="headline">Test Module</v-card-title>
                    <v-card-text>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum cupiditate tenetur ut dolorum soluta sit pariatur cum repellat velit officiis, nobis, maiores, quo asperiores id ipsa. Laudantium quas in quae.</p>
                    </v-card-text>
                    <v-btn @click="mediabox.model = true">Mediabox</v-btn>

                    <v-stepper v-model="e6" vertical class="elevation-0">
                        <v-divider></v-divider>
                        <v-stepper-step :editable="e6 > 1" step="1" complete>
                            Introduction
                        </v-stepper-step>
                        <v-stepper-content step="1">
                            <v-card-text>
                                Short description for this section.
                                <br>
                                <v-btn v-if="e6 > 0" primary @click.native="e6 = 2">Start</v-btn>
                            </v-card-text>
                        </v-stepper-content>

                        <v-stepper-step :editable="e6 > 2" step="2" v-bind:complete="e6 > 2">Introduction Video</v-stepper-step>
                        <v-stepper-content step="2">
                            <v-btn primary @click.native="e6 = 3">Start</v-btn>
                        </v-stepper-content>

                        <v-stepper-step :editable="e6 > 3" step="3" v-bind:complete="e6 > 3">Video</v-stepper-step>
                        <v-stepper-content step="3">
                            <v-btn primary @click.native="e6 = 4">Next</v-btn>
                        </v-stepper-content>

                        <v-stepper-step :editable="e6 > 4" step="4">Symptoms of Stress</v-stepper-step>
                        <v-stepper-content step="4">
                            <v-btn primary @click.native="e6 = 1">Next</v-btn>
                        </v-stepper-content>
                    </v-stepper>

                </v-card>
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
                    tab: 2,
                    e6: 1,
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
