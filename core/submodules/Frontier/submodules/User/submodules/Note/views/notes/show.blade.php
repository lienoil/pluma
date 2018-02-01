@extends("Theme::layouts.admin")

@section("head-title", __("My Notes"))

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

                @include("Setting::partials.settingsbar")

            </v-flex>
            <v-flex sm9 md10>
                <v-layout row wrap>
                    <v-flex xs4>

                        {{-- @foreach ($resource->notes as $note) --}}
                            <v-card class="elevation-1" :key="i" v-for="(note, i) in resources.items">
                                <v-toolbar card class="transparent">
                                    <v-toolbar-title class="headline" v-html="note.title"></v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-btn small icon @click="remove(resources.items, i)"><v-icon>close</v-icon></v-btn>
                                </v-toolbar>
                                <v-card-text v-html="note.text"></v-card-text>
                            </v-card>
                        {{-- @endforeach --}}

                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('note/js/notes.js') }}"></script>
@endpush
