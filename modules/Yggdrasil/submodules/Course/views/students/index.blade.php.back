@extends("Theme::layouts.admin")


@section("content")
    @include("Theme::partials.banner")
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex md6 xs12>
                <v-card class="elevation-1" height="100%">
                    <v-toolbar dark flat class="secondary">
                        <v-icon left dark>playlist_add_check</v-icon>
                        <v-toolbar-title>{{ __('List of Students') }}</v-toolbar-title>
                    </v-toolbar>

                    <v-card-text class="pa-0">
                        <v-list class="list-container" two-line>
                            @foreach ($resource->students as $student)
                                <v-list-tile avatar ripple>
                                    <v-list-tile-avatar>
                                        <img src="{{ $student->avatar }}">
                                    </v-list-tile-avatar>
                                    <v-list-tile-content>
                                        <v-list-tile-title>{{ $student->displayname }}</v-list-tile-title>
                                        <v-list-tile-sub-title>Progress: {{ $student->courses()->find($resource->id)->progress }}%</v-list-tile-sub-title>
                                    </v-list-tile-content>
                                    <v-list-tile-action class="grey--text">
                                        {{-- {{ $student->courses()->find($resource->id)->progress }} --}}
                                        <v-chip class="success white--text">Active</v-chip>
                                    </v-list-tile-action>
                                </v-list-tile>
                            @endforeach
                        </v-list>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
    </v-container>
@endsection

@push('css')
    <style>
        .td-n:focus,
        .td-n:hover,
        .td-n:focus:visited {
            text-decoration: none !important;
        }

        .list-container {
            position: relative;
            height: 70vh;
            overflow-y: auto !important;
        }
    </style>
@endpush

