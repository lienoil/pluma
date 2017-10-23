@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="elevation-1 brown">
        <v-toolbar-title class="">{{ __('Packages') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-flex sm12>
            <v-dataset></v-dataset>
        </v-flex>
    </v-container>

@endsection
