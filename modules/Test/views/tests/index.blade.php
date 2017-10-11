@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm12>

                <v-category
                    :urls="{GET:'{{ route('api.categories.all') }}', POST: '{{ route('api.categories.store') }}'}"
                    input-value="id"
                    input-text="name"
                    v-model="catalogue.selected"
                    :list="cataloguesObj"
                    icon="label"
                    label="Category"
                >
                    <template slot="form" scope="{props}">
                        <v-card-text>
                            <input type="hidden" v-model="props.dataset.item._token" name="_token" value="{{ csrf_token() }}">
                            <v-text-field :error-messages="props.dataset.errors.name" v-model="props.dataset.item.name" name="name" label="{{ __('Name') }}"></v-text-field>
                            <v-text-field :error-messages="props.dataset.errors.alias" v-model="props.dataset.item.alias" name="alias" label="{{ __('Alias') }}"></v-text-field>
                            <v-text-field :error-messages="props.dataset.errors.code" v-model="props.dataset.item.code" name="code" label="{{ __('Code') }}"></v-text-field>
                            <v-text-field :error-messages="props.dataset.errors.description" v-model="props.dataset.item.description" name="description" label="{{ __('Description') }}"></v-text-field>
                            <v-text-field :error-messages="props.dataset.errors.icon" v-model="props.dataset.item.icon" name="icon" label="{{ __('Icon') }}"></v-text-field>
                            <v-text-field :error-messages="props.dataset.errors.categorable_type" v-model="props.dataset.item.categorable_type" name="categorable_type" label="{{ __('Type') }}" value="Course\Models\Course"></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn ripple primary @click.stop="props.save">{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </template>
                </v-category>
                <span v-html="catalogue.selected"></span>

                {{-- <draggable class="sortable-container" :options="{animation: 150, draggable: '.draggable-lesson', handle: '.sortable-handle', forceFallback: true}">
                    <transition-group>
                        <v-card v-for="(item, i) in 5" :key="i" class="draggable-lesson ma-3">
                            <v-toolbar card class="sortable-handle" slot="header">adasTOOL</v-toolbar>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque ratione cupiditate quidem quisquam dolore suscipit amet, quam aperiam! Labore soluta, repudiandae incidunt optio tempore debitis excepturi minus non et culpa.
                            <span></span>
                        </v-card>
                    </transition-group>
                </draggable> --}}

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

            </v-flex>
        </v-layout>
    </v-container>

@endsection

@push('post-css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
    <link rel="stylesheet" href="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.css') }}">
    <link rel="stylesheet" href="http://localhost:8080/dist/vuetify-category-card.min.css">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script src="{{ assets('library/vuetify-dropzone/dist/vuetify-dropzone.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    {{-- <script src="{{ assets('test/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script> --}}
    <script src="http://localhost:8080/dist/vuetify-category-card.min.js"></script>
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
