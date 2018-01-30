@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-toolbar dark class="elevation-1 grey darken-3">
        <v-toolbar-title>{{ $resource->name }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <form action="{{$resource->action}}" method="{{ $resource->method }}" {{ $resource->attributes }}>
                    <v-card class="elevation-1">
<<<<<<< HEAD
                            @foreach ($form->fields as $field)
                        <v-card-text>
                            {{ $field->label }}
                        </v-card-text>
                        <v-card-text>
                            <v-text-field label="Type a Message"name="{{ $field->name }}"value="{{ $field->value }}"></v-text-field>
                        </v-card-text>
                            @endforeach
=======
                        @foreach ($form->fields as $label => $field)
                        <v-card-text>
                            {{ $field->label }}
                            <v-text-field
                                label="{{ $field->label }}"
                                name="{{ $field->name }}"
                                multi-line
                                >
                            </v-text-field>
                            {!! $field->template($label)->render() !!}
                        </v-card-text>
                        @endforeach

                        <v-btn primary type="submit" class="elevation-1">{{ __('Submit') }}</v-btn>
>>>>>>> e8b02a65fa1b32147aac2dd657b223b9da3ca15b
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
