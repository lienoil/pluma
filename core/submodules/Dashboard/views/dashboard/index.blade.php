@extends("Theme::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    @include("Dashboard::widgets.glance")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>

                <v-card class="elevation-1 mb-3">
                    ad
                </v-card>

            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .inline {
            display: inline-block;
        }
        .overlay-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .media .card__text,
        .top-level {
            z-index: 1;
        }
        .weight-600 {
            font-weight: 600 !important;
        }
        .progress-circular{
            margin: 1rem;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/draggable/sortable.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/draggable/draggable.min.js') }}"></script>
    <script src="{{ assets('frontier/vuetify-mediabox/dist/vuetify-mediabox.min.js') }}"></script>
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    draggables: {
                        items: [
                            { name: 'yas', active: 'true' },
                        ],
                    },
                }
            },
            beforeDestroy () {
                clearInterval(this.interval)
            },
        })
    </script>
@endpush
