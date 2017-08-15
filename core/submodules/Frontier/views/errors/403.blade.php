@extends("Theme::layouts.admin")

@section("content")
    <v-layout row wrap>
        <v-flex sm12 class="text-xs-center">
            <h1 class="warning--text display-4 mb-0"><strong>{{ __('403') }}</strong></h1>
            <h2 class="warning--text display-1 mt-0 lh-1">{{ __('Forbidden') }}</h2>
            <p class="subheading grey--text">{{ __('This part of the app is restricted.') }}</p>
        </v-flex>
    </v-layout>
@endsection
