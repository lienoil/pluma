@extends("Frontier::layouts.master")

@section("pre-content")
    @include("Frontier::partials.sidebar")
    @include("Frontier::partials.utilitybar")
@endsection

@section("root")
    @yield("content")
@endsection

@section("post-content")
    @include("Frontier::partials.rightsidebar")
    @include("Frontier::partials.dialog")
@endsection

@section("endnote")
    <v-container fluid class="pa-0">
        <v-layout row wrap>
            <v-flex xs6>
                <small>{{ $application->site->copyright }}</small>
            </v-flex>
            <v-flex xs6 class="text-xs-right">
                <small>{{ $application->version }}</small>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
