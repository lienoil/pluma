{{--
Template Name: Home Template
Description: The default home template displaying the title, body, and featured image of the page.
Author: John Lioneil Dionisio
Version: 1.0
--}}

@extends("Template::layouts.public")

@section("content")
<v-card class="elevation-0">
    {{-- <v-parallax class="elevation-1" src="{{ $page->feature }}" height="400"></v-parallax> --}}

    <v-container grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <v-card class="elevation-1">
                    <v-card-title primary-title class="headline">{{ $page->title }}</v-card-title>
                    <v-card-text>
                        {!! $page->body !!}
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>


<v-card>
@endsection

@push('css')
    <style>
    </style>
@endpush
