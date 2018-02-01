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

                <form action="{{ $resource->action ?? route('tests.store') }}" method="{{ $resource->method }}" {!! $resource->attributes !!}>
                    {{ csrf_field() }}
                    <v-card class="elevation-1">

                        <v-toolbar class="elevation-0">
                            <v-toolbar-title>{{ $resource->name }}</v-toolbar-title>
                        </v-toolbar>

                        @foreach ($resource->fields as $label => $field)
                            <v-card-text>
                                <div class="mb-2">{!! $field->template('text')->render() !!}</div>
                            </v-card-text>
                        @endforeach

                        <v-card-actions>
                            <v-btn type="submit">{{ __('Submit') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>

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
                        item: {
                            color: '{{ old('color') }}',
                            pet: '{{ old('pet') }}',
                            foods: {!! json_encode(old('foods') ?? []) !!},
                        },
                        errors: {!! json_encode($errors->getMessages()) !!},
                    },
                }
            },
        })
    </script>
@endpush
