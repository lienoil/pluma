@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="light-blue elevation-1">
        <v-toolbar-title>{{ __('Social') }}</v-toolbar-title>
        <v-spacer></v-spacer>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")
        <v-layout row wrap>
            <v-flex xs12>
            </v-flex>
        </v-layout>
    </v-container>

@endsection
