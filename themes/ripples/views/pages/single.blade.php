@extends("Theme::layouts.public")

{{-- @section("head-title", $page->title) --}}

@section("content")
    @include("Theme::menus.main-menu")

    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex flex md6 xs12 order-lg1>
                <v-card flat class="transparent">
                    <v-card-title class="page-title">{{ __($page->name) }}</v-card-title>
                </v-card>
                <v-card-text>{!! $page->body !!}</v-card-text>
            </v-flex>
        </v-layout>
    </v-container>

@endsection
