@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid class="grey lighten-4" grid-list-lg>

        <v-slide-y-transition>
            <v-layout v-if="bulk.upload.model" row wrap>
                <v-flex>
                    @include("Theme::cards.upload")
                </v-flex>
            </v-layout>
        </v-slide-y-transition>

        <v-layout fill-height row wrap>
            <v-flex fill-height md3>
                <v-list dense class="grey lighten-4">
                    <v-subheader>{{ __('Catalogues') }}</v-subheader>

                    <v-divider class="my-1"></v-divider>

                    <v-list-tile href="{{ route('library.index') }}" :class="!suppliments.catalogues.current ? 'active--primary' : ''">
                        <v-list-tile-action>
                            <v-icon :class="!suppliments.catalogues.current ? 'white--text' : 'grey--text'">book</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content :class="!suppliments.catalogues.current ? 'white--text' : 'grey--text'">
                            <v-list-tile-title>{{ __('All') }}</v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <span class="grey--text">{{ $count }}</span>
                        </v-list-tile-action>
                    </v-list-tile>

                    <v-divider class="my-1"></v-divider>

                    <v-list-tile :href="route(urls.library.index, {catalogue: catalogue.id})" v-for="(catalogue, key) in suppliments.catalogues.items" :key="key" :class="catalogue.active ? 'active--primary' : ''">
                        <v-list-tile-action>
                            <v-icon :class="catalogue.active ? 'white--text' : 'grey--text'">@{{ catalogue.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content :class="catalogue.active ? 'white--text' : 'grey--text'">
                            <v-list-tile-title>@{{ catalogue.name }}</v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <span class="grey--text">@{{ catalogue.libraries.length }}</span>
                        </v-list-tile-action>
                    </v-list-tile>

                    <div class="mt-2">
                        <a href="{{ route('catalogues.index') }}">
                            <v-icon>add</v-icon>
                            <small>{{ __('Add new catalogue') }}</small>
                        </a>
                    </div>
                </v-list>
            </v-flex>

            <v-flex md9>
                <v-toolbar flat dense class="transparent">
                    <v-spacer></v-spacer>
                    <v-btn icon><v-icon>sort</v-icon></v-btn>
                    <v-btn icon><v-icon>search</v-icon></v-btn>
                    <v-btn icon :class="bulk.upload.model ? 'btn--active primary' : ''" @click.native.stop="bulk.upload.model = !bulk.upload.model"><v-icon>fa-cloud-upload</v-icon></v-btn>
                </v-toolbar>

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


@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        upload: {
                            model: false,
                        },
                    },
                    suppliments: {
                        catalogues: {
                            current: null,
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

            mounted () {
                this.suppliments.catalogues.current = '{{ request()->getQueryString() }}';

                for (var i = this.suppliments.catalogues.items.length - 1; i >= 0; i--) {
                    let current = this.suppliments.catalogues.items[i];
                    if (current.id == this.suppliments.catalogues.current.split('=')[1]) {
                        this.suppliments.catalogues.items[i].active = true;
                    }
                }
            }
        });
    </script>
@endpush
