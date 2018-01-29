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

                        <v-btn primary type="submit" class="elevation-1">Submit</v-btn>
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
