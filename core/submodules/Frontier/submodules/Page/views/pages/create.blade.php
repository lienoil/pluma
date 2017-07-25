@extends("Frontier::layouts.admin")

@section("content")
    <form action="{{ route('pages.store') }}" method="POST">
        <v-layout row wrap>
            <v-flex md8>
                <v-card>
                    <v-text-field></v-text-field>
                </v-card>
            </v-flex>
        </v-layout>
    </form>
@endsection

