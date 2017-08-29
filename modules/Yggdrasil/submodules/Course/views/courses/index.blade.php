@extends("Theme::layouts.admin")

@section("content")
    <v-toolbar card class="transparent pa-0">
        <v-tabs light class="pl-0 pr-0 pa-0 ma-0">
            <v-tabs-bar slot="activators" class="white">
                <v-tabs-item
                    href="#tab-all-courses"
                    ripple
                >
                    {{ __('All Courses') }}
                </v-tabs-item>
                <v-tabs-item
                    href="#tab-my-courses"
                    ripple
                >
                    {{ __('My Courses') }}
                </v-tabs-item>
                <v-tabs-item
                    href="#tab-previous-courses"
                    ripple
                >
                    {{ __('Previous') }}
                </v-tabs-item>
                <v-tabs-slider class="primary"></v-tabs-slider>
            </v-tabs-bar>
        </v-tabs>
    </v-toolbar>
    <v-container fluid>

        @include("Theme::partials.banner")

        <v-tabs-content id="tab-all-courses">
            <v-container fluid>
                <v-layout row wrap>
                    <v-flex xs12>
                        asd
                    </v-flex>
                </v-layout>
            </v-container>
        </v-tabs-content>
    </v-container>
@endsection
