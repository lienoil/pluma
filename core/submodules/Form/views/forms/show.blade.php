@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>

                {!! $builder->build() !!}

            </v-flex>
        </v-layout>
    </v-container>
@endsection
