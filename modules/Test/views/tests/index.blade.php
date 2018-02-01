@extends("Template::layouts.public")

@section("content")
<v-card class="elevation-0">
    <v-container grid-list-lg>
        <v-layout row wrap align-center justify-center >
            <v-flex lg10 md9 xs12>
                <v-toolbar class="elevation-0 transparent">
                    <v-avatar tile><img src="{{ settings('site_logo') }}" alt=""></v-avatar>
                </v-toolbar>
                <v-layout row wrap align-center justify-center>
                    <v-flex sm6 xs12 xs-order2>
                        <v-card class="elevation-0 transparent">
                            <v-card-text>
                                <p>{!! $page->body !!}</p>
                                <v-btn class="elevation-1" primary large>Get Started</v-btn>
                            </v-card-text>
                        </v-card>
                    </v-flex>

                    <v-flex sm6 xs12 xs-order1>
                        <v-card class="elevation-0 transparent">
                            <img src="{{ $page->feature }}" width="100%"/>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
<v-card>
@endsection

@push('css')
    <style>
    </style>
@endpush
