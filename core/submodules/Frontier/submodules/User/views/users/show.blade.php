@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm8 offset-sm2>
                <v-card class="mb-3 elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="accent--text">{{ __($resource->fullname) }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-subheader>{{ __('Basic Information') }}</v-subheader>

                    <v-list two-lines>
                        <v-list-tile>
                            <v-list-tile-title>
                                <div>{{ $resource->email }}</div>
                                <span class="caption grey--text">{{ __('Email') }}</span>
                            </v-list-tile-title>
                        </v-list-tile>
                    </v-list>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
