@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex sm12>

            {!! $builder->build() !!}

        </v-flex>
    </v-layout>

    <v-container fluid grid-list-lg>
    </v-container>
@endsection
