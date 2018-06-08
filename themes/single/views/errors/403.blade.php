@extends("Theme::layouts.public")

@section("head-title", __('Error 403 - Forbidden Request'))

@section("main-content")
    <v-container grid-list-lg>
        <v-layout column wrap>
            <v-flex tag="h1" class="display-4">{{ __('403') }}</v-flex>
            <v-flex tag="h2" class="display-2">{{ __('Forbidden Page') }}</v-flex>
            <v-flex>
                <p class="headline">{{ __("Sorry, this page do exists but viewing it requires higher clearance. We're certainly NOT hiding aliens behind this page. No sir.") }}</p>
                <p class="subheading">{{ __("Try searching again, or using the links below to find what you're looking for:") }}</p>

                <div class="subheading mb-1">Links</div>
                <div class="body-2 mb-1"><a href="{{ home() }}">{{ __('Home') }}</a></div>
                @if (user())
                  <div class="body-2 mb-1"><a href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a></div>
                @else
                  <div class="body-2 mb-1"><a href="{{ route('login.show') }}">{{ __('Login') }}</a></div>
                @endif
            </v-flex>
        </v-layout>
    </v-container>
@endsection
