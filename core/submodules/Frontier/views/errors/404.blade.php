@extends("Theme::layouts.public")

@section("head-title", '404 Error - Page Not Found')
@section("head-subtitle", 'Forbidden')

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm6 offset-sm3 class="text-xs-center">
                <h1 class="grey--text text--darken-3 display-5 mt-5 mb-0"><strong>{{ __('404') }}</strong></h1>
                <h2 class="grey--text text--darken-2 display-2 mt-0 lh-1">{{ __('Page Not Found') }}</h2>
                <p class="subheading grey--text">{{ __('Either something went wrong or the page does not exist anymore.') }}</p>

                {{-- <v-card-text>
                    <v-btn primary round large class="px-4 elevation-1" href="\admin/dashboard">Dashboard</v-btn>
                </v-card-text> --}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection

