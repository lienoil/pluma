@extends("Theme::layouts.public")

@section("head-title", __('Error 404 - Page Not Found'))

@section("main-content")
  <v-container grid-list-lg fill-height>
    <v-layout column wrap fill-height>
      <v-flex tag="h1" class="display-4">{{ __('404') }}</v-flex>
      <v-flex tag="h2" class="display-2">{{ __('Page Not Found') }}</v-flex>
      <v-flex>
        <p class="headline">{{ __("Either something went wrong or the page does not exist anymore.") }}</p>
        <p class="subheading">{{ __("Try searching again, or using the links below to find what you're looking for:") }}</p>

        <div class="subheading mb-1">Links</div>
        <div class="body-2 mb-1"><a href="{{ home() }}">{{ __('Home') }}</a></div>
        <div class="body-2 mb-1"><a href="{{ route('login.show') }}">{{ __('Login') }}</a></div>
          {{-- TODO:
            poplink - popular link, dynamic menu
          <a href="{{ poplink()->url }}">{{ poplink()->name }}</a> --}}
      </v-flex>
    </v-layout>
  </v-container>
@endsection

