@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex md4>
                <v-card class="elevation-1">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="subheading grey--text"><v-icon left>fa-link</v-icon> {{ __('Add Link') }}</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field label="{{ __('Name') }}" v-model="custom.name" :name="`social_links[${$options.filters.slugify(custom.name)}][name]`"></v-text-field>
                        <v-text-field label="{{ __('Icon') }}" v-model="custom.icon" :name="`social_links[${$options.filters.slugify(custom.name)}][icon]`"></v-text-field>
                        <v-text-field label="{{ __('URL') }}" v-model="custom.url" :name="`social_links[${$options.filters.slugify(custom.name)}][url]`"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn class="elevation-1" primary>{{ __('Add') }}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex md8>
                <form action="{{ route('settings.store') }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title class="subheading">{{ __('Social Links') }}</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-text-field :error-messages="errors.social_links" value="{{ settings('social_links', '', 'facebook.url') }}" prepend-icon="fa-facebook" label="{{ __('Facebook') }}" name="social_links[facebook][url]"></v-text-field>
                            <input type="hidden" name="social_links[facebook][name]" value="Facebook">
                            <input type="hidden" name="social_links[facebook][icon]" value="fa-facebook">

                            <v-text-field :error-messages="errors.social_links" value="{{ settings('social_links', '', 'twitter.url') }}" prepend-icon="fa-twitter" label="{{ __('Twitter') }}" name="social_links[twitter][url]"></v-text-field>
                            <input type="hidden" name="social_links[twitter][name]" value="Twitter">
                            <input type="hidden" name="social_links[twitter][icon]" value="fa-twitter">

                            <v-text-field :error-messages="errors.social_links" value="{{ settings('social_links', '', 'youtube.url') }}" prepend-icon="fa-youtube" label="{{ __('YouTube') }}" name="social_links[youtube][url]"></v-text-field>
                            <input type="hidden" name="social_links[youtube][name]" value="YouTube">
                            <input type="hidden" name="social_links[youtube][icon]" value="fa-youtube">

                            <v-text-field :error-messages="errors.social_links" value="{{ settings('social_links', '', 'linkedin.url') }}" prepend-icon="fa-linkedin" label="{{ __('Linkedin') }}" name="social_links[linkedin][url]"></v-text-field>
                            <input type="hidden" name="social_links[linkedin][name]" value="Linkedin">
                            <input type="hidden" name="social_links[linkedin][icon]" value="fa-linkedin">

                            <template v-for="(link, i) in links">
                                <v-text-field :prepend-icon="link.icon" :label="link.name" :name="`social_links[${i}][url]`" :value="link.url"></v-text-field>
                                <input type="hidden" :name="`social_links[${i}][name]`" :value="link.name">
                                <input type="hidden" :name="`social_links[${i}][icon]`" :value="link.icon">
                            </template>

                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn primary type="submit" class="elevation-1">{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>

@endsection

@push('pre-scripts')
    <script>
        mixins.push({
            data () {
                return {
                    links: {!! json_encode(collect($resources)->except(['facebook', 'twitter', 'youtube', 'linkedin'])->toArray()) !!},
                    custom: {name:'',icon:'',url:''},
                    errors: {!! json_encode($errors->getMessages()) !!}
                }
            }
        })
    </script>
@endpush
