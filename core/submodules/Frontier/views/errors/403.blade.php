@extends("Theme::layouts.admin")

@section("head-title", '403 Error')
@section("head-subtitle", 'Forbidden')
@section("page-title", '403 Error | Forbidden')

@section("content")
    <v-layout row wrap>
        <v-flex sm12 class="text-xs-center">
            <h1 class="warning--text display-5 mb-0"><strong>{{ __('403') }}</strong></h1>
            <h2 class="warning--text display-2 mt-0 lh-1">{{ __('Forbidden') }}</h2>
            <p class="subheading grey--text">{{ __('This part of the app is restricted.') }}</p>
        </v-flex>
    </v-layout>
@endsection
