@extends("Theme::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex xs12>

            <v-toolbar class="transparent elevation-0">
                <v-toolbar-title class="grey--text">{{ __('Themes') }}</v-toolbar-title>
                <v-spacer></v-spacer>
                {{-- Search --}}
                <v-slide-y-transition>
                    <v-text-field
                        append-icon="search"
                        label="{{ _('Search Themes') }}"
                        single-line
                        hide-details
                        v-if="dataset.searchform.model"
                        v-model="dataset.searchform.query"
                        light
                    ></v-text-field>
                </v-slide-y-transition>
                <v-btn v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" icon flat light @click.native="dataset.searchform.model = !dataset.searchform.model; dataset.searchform.query = '';">
                    <v-icon>@{{ !dataset.searchform.model ? 'search' : 'clear' }}</v-icon>
                </v-btn>
                {{-- /Search --}}
            </v-toolbar>

            <v-layout row wrap>
                @foreach ($resources as $resource)
                <v-flex sm4>
                    <v-card class="mb-3 elevation-1">
                        <v-card-media src="{{ $resource->preview }}" height="180px"></v-card-media>
                        <v-card-title primary-title>
                            <h3 class="headline accent--text">{{ @$resource->theme->name }}</h3>
                            <p>{{ @$resource->theme->description }}</p>
                        </v-card-title>
                        <form action="{{ route('settings.store') }}" method="POST">
                            {{ csrf_field() }}
                            <v-card-text>
                                <v-btn accent>{{ __('Set as Active') }}</v-btn>
                            </v-card-text>
                        </form>
                    </v-card>
                </v-flex>
                @endforeach
            </v-layout>
        </v-flex>
    </v-layout>

@endsection


@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    dataset: {
                        searchform: {
                            model: true,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            grants: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },
        });
    </script>
@endpush
