@extends("Theme::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex sm6 md8 xs12>

            <v-card class="mb-3 elevation-1">
                <v-toolbar class="transparent elevation-0">
                    <v-toolbar-title class="accent--text">{{ __('General Settings') }}</v-toolbar-title>
                </v-toolbar>

                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card-text>
                        <v-text-field
                            label="{{ __('Site Title') }}"
                            name="site_title"
                            input-group
                            hide-details
                            value="{{ old('site_title') ? old('site_title') : @$resource->site_title }}"
                        ></v-text-field>
                        <v-text-field
                            label="{{ __('Site Tagline') }}"
                            name="site_tagline"
                            input-group
                            hide-details
                            value="{{ old('site_tagline') ? old('site_tagline') : @$resource->site_tagline }}"
                        ></v-text-field>
                        <v-text-field
                            label="{{ __('Site Email Address') }}"
                            name="site_email"
                            input-group
                            hide-details
                            value="{{ old('site_email') ? old('site_email') : @$resource->site_email }}"
                        ></v-text-field>
                        <p>
                            TODO: Membership:
                            <br>
                            * Noone can register <br>
                            * Register via email requests <br>
                            * Register as Subscriber <br>
                            * Register as Guest <br>
                        </p>
                        <p>
                            TODO: Date Format <br>
                            TODO: Time Format <br>
                            TODO: Week starts on (Sunday, Monday...)
                        </p>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                    </v-card-actions>
                </form>

            </v-card>

        </v-flex>
    </v-layout>
@endsection
