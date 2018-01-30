@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <form action="{{$resource->action}}" method="{{ $resource->method }}" {{ $resource->attributes }}>
                    <v-card class="elevation-1">
                        <v-toolbar class="elevation-0">
                            <v-toolbar-title>{{ $resource->name }}</v-toolbar-title>
                        </v-toolbar>

                        @foreach ($form->fields as $field)
                            <v-card-text>
                                {{ $field->label }}
                            </v-card-text>
                            <v-card-text>
                                <v-text-field label="Type a Message" name="{{ $field->name }}" value="{{ $field->value }}"></v-text-field>
                            </v-card-text>

                            <v-card-text>
                                <v-radio-group v-model="radio" :mandatory="false">
                                    <v-radio label="{{ $field->value }}" value="{{ $field->value }}"></v-radio>
                                </v-radio-group>
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
                    radio: null,
                };
            },
        });
    </script>
@endpush
