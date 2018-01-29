@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>


                {{-- @include("Setting::partials.settingsbar") --}}

                {!! $form->build() !!}


            </v-flex>
        </v-layout>
    </v-container>
@endsection
