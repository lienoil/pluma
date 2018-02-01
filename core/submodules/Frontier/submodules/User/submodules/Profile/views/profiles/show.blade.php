@extends("Theme::layouts.admin")

@section("head-title", __("Profile"))

@section("content")

    <v-parallax height="280" src="{{ $resource->setting('user_profile_banner', '') }}" class="primary lighten-4 elevation-0">
        {{-- <div class="text-xs-right"><v-btn icon class="grey--text darken-1"><v-icon>photo_camera</v-icon></v-btn></div> --}}
        <v-layout row wrap align-end justify-bottom>
            <v-flex xs12>
                <v-card dark class="elevation-0 transparent" row>
                    <v-card-text>
                        <v-avatar tile size="120px" class="elevation-0">
                            <img src="{{ $resource->avatar }}" alt="{{ $resource->fullname }}" height="120">
                        </v-avatar>
                        <div class="title pt-2">{{ $resource->fullname }}</div>
                        <div class="subheading pb-2">{{ $resource->displayrole }}</div>
                    </v-card-text>
                </v-card>
            </v-flex xs12>
        </v-layout>
    </v-parallax>

    @include("Frontier::partials.banner")

    <v-card class="elevation-1">
        <v-toolbar class="white elevation-0">
            <v-spacer></v-spacer>
            @user($resource->id)
                <v-btn round outline href="{{ route('profile.edit', $resource->handlename) }}" class="primary--text text--lighten-3">{{ __('Edit Profile') }}</v-btn>
            @enduser
        </v-toolbar>
    </v-card>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm3 md2>
                {{-- {{ dd("s", navigation('current')) }} --}}
                @include("Setting::partials.settingsbar")
                {{-- <v-layout row wrap>
                    <v-flex xs12>

                        <v-card dark class="elevation-1" style="background: linear-gradient(141deg, #f2a8ff 0%, #c5a5ff 51%, #91a1f7 75%);">
                            <v-card-text class="subheading">
                                <div class="white--text">2 courses enrolled </div>
                            </v-card-text>
                        </v-card>

                    </v-flex>
                    <v-flex xs12>
                        @include("Dashboard::widgets.todo-list")
                    </v-flex>
                </v-layout> --}}
            </v-flex>
            <v-flex sm9 md10>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-card>
                            <v-tabs dark fixed>
                                <v-tabs-bar class="purple lighten-2">
                                    <v-tabs-slider class="purple darken-2"></v-tabs-slider>
                                    <v-tabs-item class="body-1" href="about">{{ __('About') }}</v-tabs-item>
                                    <v-tabs-item class="body-1" href="mycourses">{{ __('My Courses') }}</v-tabs-item>
                                    <v-tabs-item class="body-1" href="achievements">{{ __('Achievements') }}</v-tabs-item>
                                </v-tabs-bar>
                                <v-tabs-items>
                                    <v-tabs-content id="about">
                                        <v-card flat>
                                            <v-card-text>
                                                <v-subheader class="pl-0">{{ __('Basic Information') }}</v-subheader>
                                                <v-layout row wrap>
                                                    <v-flex xs4 class="grey--text body-1">
                                                        {{ __('Full Name') }}
                                                    </v-flex>

                                                    <v-flex xs8 class="body-1">
                                                        {{ $resource->fullname }}
                                                    </v-flex>
                                                </v-layout>
                                                <v-layout row wrap>
                                                    <v-flex xs4 class="grey--text body-1">
                                                        {{ __('Email Address') }}
                                                    </v-flex>

                                                    <v-flex xs8 class="body-1">
                                                        {{ $resource->email }}
                                                    </v-flex>
                                                </v-layout>
                                                <v-subheader class="pl-0">Other Details</v-subheader>
                                                <v-layout row wrap>
                                                    <v-flex xs4 class="grey--text body-1">
                                                        {{ __('Gender') }}
                                                    </v-flex>

                                                    <v-flex xs8 class="body-1">
                                                        {{ $resource->detail('gender') }}
                                                    </v-flex>
                                                </v-layout>
                                                <v-layout row wrap>
                                                    <v-flex xs4 class="grey--text body-1">
                                                        {{ __('Birthday') }}
                                                    </v-flex>

                                                    <v-flex xs8 class="body-1">
                                                        {{ $resource->detail('birthday') }}
                                                    </v-flex>
                                                </v-layout>
                                                <v-layout row wrap>
                                                    <v-flex xs4 class="grey--text body-1">
                                                        {{ __('Home Address') }}
                                                    </v-flex>

                                                    <v-flex xs8 class="body-1">
                                                        {{ $resource->detail('home_address') }}
                                                    </v-flex>
                                                </v-layout>
                                                <v-layout row wrap>
                                                    <v-flex xs4 class="grey--text body-1">
                                                        {{ __('Phone Number') }}
                                                    </v-flex>

                                                    <v-flex xs8 class="body-1">
                                                        {{ $resource->detail('phone_number') }}
                                                    </v-flex>
                                                </v-layout>
                                            </v-card-text>
                                        </v-card>
                                    </v-tabs-content>
                                    <v-tabs-content id="mycourses">
                                        <v-list two-line>
                                            <v-list-tile avatar ripple @click="">
                                                <v-list-tile-avatar>
                                                    <v-icon>account_circle</v-icon>
                                                </v-list-tile-avatar>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>Hello, universe!</v-list-tile-title>
                                                    <v-list-tile-sub-title>Hello, universe!</v-list-tile-sub-title>
                                                </v-list-tile-content>
                                                <v-list-tile-action>
                                                    <v-btn icon ripple>
                                                        <v-icon color="grey lighten-1">info</v-icon>
                                                    </v-btn>
                                                </v-list-tile-action>
                                            </v-list-tile>
                                        </v-list>
                                    </v-tabs-content>
                                    <v-tabs-content id="achievements">
                                        <v-card flat>
                                            <v-card-text class="grey--text">No Achievements yet..</v-card-text>
                                        </v-card>
                                    </v-tabs-content>
                                </v-tabs-items>
                            </v-tabs>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    //
                }
            },
        });
    </script>
@endpush
