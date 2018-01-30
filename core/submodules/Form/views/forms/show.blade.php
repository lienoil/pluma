@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap justify-center align-center>
            <v-flex md8 sm10 xs12>

                {{-- @include("Form::templates.test") --}}

                <form action="{{$resource->action}}" method="{{ $resource->method }}" {{ $resource->attributes }}>
                    <v-card class="elevation-1">

                        <v-toolbar class="elevation-0">
                            <v-toolbar-title>{{ $resource->name }}</v-toolbar-title>
                        </v-toolbar>

                        @foreach ($form->fields as $label => $field)
                        <v-card-text>
                            <div class="mb-2 body-1 black--text">{{ $field->label }}</div>
                            <div class="mb-2">{!! $field->template($field)->render() !!}</div>
                        </v-card-text>
                        @endforeach
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    evaluation: {
                        dialog: {
                            model: false,
                        },
                    },
                    e1: 0,
                    column: null,
                    a1: null,
                    a2: null,
                    a3: null,
                    o1: null,
                    o2: null,
                    b1: 7,
                    b2: 9,
                    b3: 8,
                    e3: 1,
                    e31: true,
                    text: 'center'
                };
            },
        });
    </script>
@endpush
