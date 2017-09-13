@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")
        <v-layout row wrap>
            <v-flex sm12>
                <v-card class="elevation-1">
                    <v-card-title class="headline">Post-workshop Evaluation Form</v-card-title>
                    <v-card-text>
                        {{-- text fields... --}}
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
