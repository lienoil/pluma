@extends("Theme::layouts.admin")

@section("content")

    <v-toolbar dark class="grey darken-4 elevation-0">
        <v-icon class="white--text">{{ navigations('current')->icon }}</v-icon>
        <v-toolbar-title class="white--text">{{ __('System Information') }}</v-toolbar-title>
    </v-toolbar>

    <v-container fluid grid-list-lg class="grey darken-3">

        <v-layout row wrap>

            <v-flex sm3 md2>
                @include("Setting::partials.settingsbar")
            </v-flex>

            <v-flex sm9 md10>
                <form action="{{ route('settings.system.configuration.store') }}" method="POST">
                    {{ csrf_token() }}
                    <v-text-field></v-text-field>
                </form>
            </v-flex>

        </v-layout>
    </v-container>
@endsection
