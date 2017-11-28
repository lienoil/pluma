<v-card class="mb-3 elevation-1">
    <v-toolbar card dense class="transparent">
        <v-icon class="accent--text">perm_media</v-icon>
        <v-toolbar-title class="subheading accent--text">{{ __('Featured Image') }}</v-toolbar-title>
    </v-toolbar>

    <v-mediabox
        {{-- :categories="featuredImage.categories" --}}
        :dropzone-options="{url:'{{ route('api.library.upload') }}', autoProcessQueue: true}"
        :dropzone-params="{_token: '{{ csrf_token() }}'}"
        :multiple="false"
        {{-- :old="featuredImage.old" --}}
        :open="featuredImage.model"
        auto-remove-files
        close-on-click
        dropzone
        search="mime:image"
        toolbar-icon="perm_media"
        toolbar-label="{{ __('Featured Image') }}"
        @selected="value => { featuredImage.new = value[0] }"
        @category-change="val => featuredImage.category.current = val"
        @sending="({file, params}) => { params.catalogue_id = featuredImage.category.current.id; params.originalname = file.upload.filename}"
    ></v-mediabox>

    <v-card-text v-if="!featuredImage.new" class="text-xs-center">
        <v-fade-transition>
            <div v-show="!featuredImage.new" class="my-2">
                <v-icon x-large class="grey--text text--lighten-2">perm_media</v-icon>
                <p class="ma-0 caption grey--text text--lighten-2">{{ __('No Image') }}</p>
            </div>
        </v-fade-transition>
    </v-card-text>

    <div v-else class="pa-2">
        <img
            width="100%"
            height="auto"
            :src="featuredImage.new ? featuredImage.new.thumbnail : ''"
            role="button"
            @click.stop="featuredImage.model = !featuredImage.model"
        >
    </div>
    <input type="hidden" name="feature_obj" :value="JSON.stringify(featuredImage.new)">
    <input type="hidden" name="feature" :value="featuredImage.new ? featuredImage.new.thumbnail : ''">
    <v-card-actions>
        <v-btn v-if="featuredImage.new" flat @click.stop="featuredImage.new = null">{{ __('Remove') }}</v-btn>
        <v-spacer></v-spacer>
        <v-btn flat @click.stop="featuredImage.model = !featuredImage.model"><span v-html="featuredImage.new ? '{{ __('Change') }}' : '{{ __('Browse') }}'"></span></v-btn>
    </v-card-actions>
</v-card>

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script src="{{ assets('frontier/js/mixins/featured-image.js?v=23s') }}"></script>
    <script>
        let fm = FeaturedImage.init({
            categories: {!! json_encode($catalogues) !!},
            old: '{!! old('feature_obj') !!}' ? JSON.parse('{!! old('feature_obj') !!}') : [],
        });

        Vue.use(VueResource);
        // mixins.push(fm);
        mixins.push({
            data () {
                return {
                    featuredImage: {
                        categories: [],
                        current: null,
                        new: null,
                        old: [],
                        category: {
                            current: {},
                        },
                        model: false,
                    }
                }
            },

            mounted () {
                this.featuredImage.categories = JSON.parse(JSON.stringify({!! json_encode($catalogues) !!}));
                this.featuredImage.old = '{!! old('feature_obj') !!}' ? JSON.parse('{!! old('feature_obj') !!}') : [];
            },
        })
    </script>
@endpush
