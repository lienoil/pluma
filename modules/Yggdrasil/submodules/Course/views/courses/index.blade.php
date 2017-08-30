@extends("Theme::layouts.admin")

@section("content")
    <v-container fluid class="pa-0">
        <v-tabs light scrollable="false">
            <v-tabs-bar slot="activators" class="white">
                <v-tabs-slider class="primary"></v-tabs-slider>
                <v-tabs-item
                    href="#tab-all-courses"
                    ripple
                    class="proper-case"
                >
                    {{ __('All Courses') }}
                </v-tabs-item>
                <v-tabs-item
                    href="#tab-my-courses"
                    ripple
                    class="proper-case"
                >
                    {{ __('My Courses') }}
                </v-tabs-item>
                <v-tabs-item
                    href="#tab-previous-courses"
                    ripple
                    class="proper-case"
                >
                    {{ __('Previous') }}
                </v-tabs-item>
            </v-tabs-bar>
            <v-tabs-content id="tab-all-courses">
                <v-container fluid>
                    <v-layout row wrap>
                        <v-flex>
                            {{--  --}}
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-tabs-content>
            <v-tabs-content id="tab-my-courses">My Lorem ipsum dolor.</v-tabs-content>
        </v-tabs>
    </v-container>
    {{-- <v-container fluid>

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
    </v-container> --}}
@endsection
