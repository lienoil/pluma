@extends("Frontier::layouts.public")

@section("head-title", __("404 Error - Page Not Found"))

@section("content")

    <v-layout row wrap>
        <v-flex xs8 offset-xs2>

            <h1 class="display-6 mt-4 mb-0 accent--text"><strong>{{ __('404 Error') }}</strong></h1>
            <p class="display-3 mt-0 grey--text">{{ __('Page Not Found') }}</p>

        </v-flex>
    </v-layout>

@endsection
