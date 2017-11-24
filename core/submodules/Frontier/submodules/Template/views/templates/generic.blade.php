{{--
Template Name: Generic Template
Description: A simple template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

@extends("Template::layouts.public")

@section("content")
    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                @include("Template::partials.main-menu")
                <v-card class="elevation-1">
                    <v-card-title primary-title class="headline">{{ $page->title }}</v-card-title>
                    <v-card-text>
                        {!! $page->body !!}
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
