@extends("Theme::layouts.public")

@section("head-title", __('Error 403 - Forbidden Request'))

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout column wrap align-center justify-center>
            <v-flex tag="h1" align-center justify-center class="display-4">{{ __('403') }}</v-flex>
            <v-flex tag="h2" align-center justify-center class="display-2">{{ __('Forbidden Page') }}</v-flex>
            <v-flex align-center justify-center class="text-xs-center">
                <p>{{ __("Sorry, this is above your clearance code. We're certainly NOT hiding aliens behind this page!") }}</p>

                <v-btn large color="primary" href="{{ home() }}">{{ __('Back to Home') }}</v-btn>
                @if (user())
                    <v-btn large color="secondary" href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</v-btn>
                @endif
            </v-flex>
        </v-layout>
    </v-container>
@endsection

