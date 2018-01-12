@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar dark class="primary elevation-1 sticky">
        <v-icon dark left>widgets</v-icon>
        <v-toolbar-title>{{ __('Widgets') }}</v-toolbar-title>
        <v-spacer></v-spacer>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm4>
                <v-card class="mb-3 elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="subheading">{{ __('Available Widgets') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        @foreach ($widgets as $widget)
                            @php
                                dd($widget);
                            @endphp
                        @endforeach
                    </v-card-text>
                </v-card>
            </v-flex>
            <v-flex sm8>
                {{--  --}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection
