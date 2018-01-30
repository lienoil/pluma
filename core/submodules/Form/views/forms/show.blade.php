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
                            @foreach ($form->fields as $field)
                        <v-card-text>
                            {{ $field->label }}
                        </v-card-text>
                        <v-card-text>
                            <v-text-field label="Type a Message"name="{{ $field->name }}"value="{{ $field->value }}"></v-text-field>
                        </v-card-text>
                            @endforeach
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
