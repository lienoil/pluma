@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm12>
                <img width="50px" src="http://pixelartmaker.com/art/0512a7cafff7675.png">
                <div>{{ __('Use the source, Luke.') }}</div>
                <br>
                {{-- @include("Setting::partials.settingsbar") --}}

                {{-- {!! $form->build() !!} --}}

                {{-- {{ dd(user()->settings('user_profile_banner')) }} --}}

                <div v-for="(user, i) in dataset.items">
                    <a :href="route(url.user.admin.edit, user.id)" v-html="user.fullname"></a>
                </div>
                <v-divider></v-divider>
                <div v-for="(page, i) in page.items">
                    <a :href="route(url.page.admin.edit, page.id)" v-html="page.title"></a> {{ __('by') }} <small v-html="page.author"></small>
                    {{-- <img width="100px" :src="page.feature"> --}}
                    <div v-html="page.body"></div>
                </div>

                <div v-for="(pages, i) in page.items">
                    <a :href="route(url.user.admin.edit, page.id)"
                        v-html="page.name">
                        {{ __('by') }}
                        <small v-html="page.author"></small>
                    </a>
                    <div v-html="page.body"></div>
                </div>

                <div class="">
            </v-flex>
        </v-layout>
    </v-container>
<v-card>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('test/js/test.js') }}"></script>
@endpush
