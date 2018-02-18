@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid class="pa-0">
        <v-flex sm12 class="pa-4">
            <p class="grey--text"><v-icon>fa-flask</v-icon>Test Page.</p>
            <p class="subheading"></p>
            <p>Test starts after horizontal line.</p>
        </v-flex>
        <v-divider class="mb-4"></v-divider>

        <v-container fluid>
            <v-flex sm12>

                <v-card class="elevation-1 mb-3">
                    <v-card-text>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea incidunt, veritatis quam inventore tenetur cumque natus iste ut fugiat dolorum aut illum. Pariatur temporibus suscipit eum ipsam veritatis recusandae voluptatum?</p>
                        <v-btn primary class="elevation-1">{{ __('Submit') }}</v-btn>
                    </v-card-text>
                </v-card>

                <v-card class="elevation-1 mb-3">
                    @include("Comment::comments.comments", [''])
                </v-card>

            </v-flex>
        </v-container>
    </v-container>
@endsection


@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                        item: {!! json_encode(old() ?? []) !!},
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },
                }
            },
        })
    </script>
@endpush

