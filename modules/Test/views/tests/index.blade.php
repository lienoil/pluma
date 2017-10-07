@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm12>

                <draggable class="sortable-container" :options="{animation: 150, handle: '.sortable-handle', group: 'lessons', draggable: '.draggable-lesson', forceFallback: true}">
                    {{-- <transition-group> --}}
                        <v-card class="draggable-lesson ma-3" v-for="(draggable, key) in draggables.items">
                            <v-toolbar card class="sortable-handle" slot="header">adasTOOL</v-toolbar>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque ratione cupiditate quidem quisquam dolore suscipit amet, quam aperiam! Labore soluta, repudiandae incidunt optio tempore debitis excepturi minus non et culpa.
                            <span v-html="draggable.name"></span>
                        </v-card>
                        <v-card class="draggable-lesson ma-3" v-for="(draggable, key) in draggables.items">
                            <v-toolbar card class="sortable-handle" slot="header">adasTOOL</v-toolbar>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque ratione cupiditate quidem quisquam dolore suscipit amet, quam aperiam! Labore soluta, repudiandae incidunt optio tempore debitis excepturi minus non et culpa.
                            <span v-html="draggable.name"></span>
                        </v-card>
                        <v-card class="draggable-lesson ma-3" v-for="(draggable, key) in draggables.items">
                            <v-toolbar card class="sortable-handle" slot="header">adasTOOL</v-toolbar>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque ratione cupiditate quidem quisquam dolore suscipit amet, quam aperiam! Labore soluta, repudiandae incidunt optio tempore debitis excepturi minus non et culpa.
                            <span v-html="draggable.name"></span>
                        </v-card>
                    {{-- </transition-group> --}}
                </draggable>



                <v-card class="mb-3 mt-5">
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

                    {{-- <v-quill source v-model="quill.content"></v-quill> --}}
                <v-card class="mb-3 elevation-1">

                    <v-btn @click="mediabox.model = !mediabox.model" ripple>Mediabox</v-btn>
                    <v-mediabox
                        url="{{ route('api.library.all') }}"
                        dropzone :multiple="false" :categories="cataloguesObj" v-model="mediabox.model"
                        :dropzone-options="{url: '{{ route('api.library.upload') }}', autoProcessQueue: true}"
                        :dropzone-params="{'_token':'{{ csrf_token() }}', catalogue_id: catalogue_id}"
                        @category-change="(cat) => {catalogue.selected=cat}"
                    >
                        <template slot="dropzone">
                            <template>
                                <em class="grey--text caption">{{ __('Upload will be catalogued as ') }} <strong v-html="catalogue.selected.name?catalogue.selected.name:'Uncategorised'"></strong></em>
                                <input type="hidden" name="catalogue_id" :value="catalogue.selected.id">
                                {{-- <span v-html="catalogue.selected"></span> --}}
                            </template>
                        </template>
                    </v-mediabox>
                    {{-- <span v-html="catalogue.selected"></span> --}}
                </v-card>

                {{-- <v-card class="elevation-1">
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

                </v-card> --}}
            </v-flex>
        </v-layout>
    </v-container>

@endsection

@push('post-css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
    <link rel="stylesheet" href="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.css') }}">
    <link rel="stylesheet" href="http://localhost:8080/dist/vuetify-mediabox.min.css">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script src="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    {{-- <script src="{{ assets('test/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script> --}}
    <script src="http://localhost:8080/dist/vuetify-mediabox.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    tab: 2,
                    cataloguesObj: {!! json_encode($cataloguesObj) !!},
                    catalogue: {selected: {}},
                    catalogue_id: null,
                    quill: {
                        content: {}
                    },
                    e6: 1,
                    draggables: {
                        items: [{name: 'asd', active: true}]
                    },
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
