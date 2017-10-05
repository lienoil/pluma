@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")
        <v-layout row wrap>
            <v-flex sm12>

                <v-card>
                    <v-dropzone :options="{url:'{{ route('api.library.upload') }}'}" :params="{'_token':'{{ csrf_token() }}', 'catalogue': catalogue}">
                        <template>
                            <v-select
                              v-bind:items="catalogues"
                              v-model="catalogue"
                              label="Select"
                              class="input-group--focused"
                              item-text="name"
                              item-value="id"
                            ></v-select>
                            <span v-html="catalogue"></span>
                        </template>
                    </v-dropzone>
                </v-card>

                <v-card class="mb-3 elevation-1">
                    <v-quill source v-model="quill.content"></v-quill>
                </v-card>

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

@push('post-css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
    <link rel="stylesheet" href="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('test/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    tab: 2,
                    catalogue: 'default',
                    quill: {
                        content: {}
                    },
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
