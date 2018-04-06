@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar dark class="sticky secondary elevation-1">
        <v-icon left dark>find_in_page</v-icon>
        <v-toolbar-title>{{ __('Create Page') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        @include("Theme::cards.save")
    </v-toolbar>
    <v-container fluid class="pa-0">
        <v-layout row wrap>
            <v-flex sm12>
                <div id="grapesjs-container">
                    @include("Test::templates.home")
                    <style>.section{padding:20px;}</style>
                </div>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <script src="https://unpkg.com/grapesjs"></script>
@endpush

@push('js')
    <script>
        var editor = grapesjs.init({
            container: '#grapesjs-container',
            storageManager: { type: 'none' },
            fromElement: true,
        })
    </script>
@endpush
