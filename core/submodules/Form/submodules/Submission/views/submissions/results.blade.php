@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-toolbar dark extended class="light-blue elevation-0">
        <v-btn
            href="{{ route('submissions.index') }}"
            ripple
            flat
            >
            <v-icon left dark>arrow_back</v-icon>
            Back
        </v-btn>
    </v-toolbar>

    <v-container fluid>
        <v-layout row wrap>
            <v-flex xs12>
                {{--  --}}
            </v-flex>
        </v-layout>
    </v-container>
@endsection
