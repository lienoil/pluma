@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                @include("Theme::partials.banner")

                {{-- @foreach (widgets('test') as $widget)
                    @include($widget->view)
                @endforeach --}}

                @include(widgets('test')->view)

            </v-flex>
        </v-layout>
    </v-container>
@endsection
