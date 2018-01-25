@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 md2>

                @include("Setting::partials.settingsbar")

            </v-flex>

            <v-flex sm9 md5>

                <v-card class="mb-3 elevation-1">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('Displaying Data') }}</v-toolbar-title>
                    </v-toolbar>

                    <form action="{{ route('settings.display.store') }}" method="POST">
                        {{ csrf_field() }}
                        <v-card-text>
                            {{--  --}}
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </form>

                </v-card>

            </v-flex>
        </v-layout>
    </v-container>
@endsection

