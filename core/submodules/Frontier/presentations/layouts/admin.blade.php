@extends("Frontier::layouts.master")

@push("root")
    @include("Frontier::components.navigation-drawer")
    @include("Frontier::components.toolbar")
    <main>
        <v-container fluid>
            <v-layout align-center justify-center>
                @yield("content")
                {{-- <router-view></router-view> --}}
            </v-layout>
        </v-container>
    </main>
    @include("Frontier::components.endnote")
@endpush
