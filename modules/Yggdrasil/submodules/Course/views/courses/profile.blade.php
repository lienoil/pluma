@extends("Theme::layouts.admin")

@section("head-title", __("My Courses"))

@section("content")

    @include("Theme::partials.profile-banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm3 md2>
                @include("Setting::partials.settingsbar")
            </v-flex>
            <v-flex sm9 md10>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-card class="elevation-1 grey--text mb-3">
                            <v-card-text class="page-content">
                                <v-subheader class="pl-0">{{ __('Current Courses') }}</v-subheader>

                                @if ($resource->courses->isEmpty())
                                    <p class="grey--text">{{ __('Your courses will display here.') }}</p>
                                @endif

                                @foreach ($resource->courses as $course)
                                    <p class="subheading">{{ $course->title }}</p>
                                @endforeach
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
@endsection
