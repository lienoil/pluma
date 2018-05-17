@extends("Theme::layouts.public")

@section("head-title", __('Error 404 - Page Not Found'))

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout column wrap align-center justify-center>
            <v-flex tag="h1" align-center justify-center class="display-4">{{ __('404') }}</v-flex>
            <v-flex tag="h2" align-center justify-center class="display-2">{{ __('Page Not Found') }}</v-flex>
            <v-flex align-center justify-center class="text-xs-center">
                <p>{{ __("Either something went wrong or the page does not exist anymore") }}</p>

                <v-btn large color="primary" href="{{ home() }}">{{ __('Back to Home') }}</v-btn>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

