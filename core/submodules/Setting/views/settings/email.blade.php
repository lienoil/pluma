@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>

        @include("Theme::partials.banner")

        <v-layout row wrap>
            <v-flex sm3 md2>

                @include("Setting::partials.settingsbar")

            </v-flex>

            <v-flex sm9 md5>

                <form action="{{ route('settings.email.store') }}" method="POST">
                    {{ csrf_field() }}

                    <v-card class="mb-3 elevation-1">
                        <v-toolbar class="transparent elevation-0">
                            <v-toolbar-title class="accent--text">{{ __('Email Options') }}</v-toolbar-title>
                        </v-toolbar>

                        <v-subheader>{{ __("Mail Settings") }}</v-subheader>
                        <v-card-text class="grey--text body-1">
                            <v-text-field :error-messages="errors.MAIL_FROM_NAME" name="MAIL_FROM_NAME" label="{{ __('From Name') }}" v-model="resource.item.MAIL_FROM_NAME"></v-text-field>
                            <v-text-field :error-messages="errors.MAIL_FROM_ADDRESS" name="MAIL_FROM_ADDRESS" label="{{ __('From Address') }}" v-model="resource.item.MAIL_FROM_ADDRESS"></v-text-field>
                        </v-card-text>

                        <v-subheader>{{ __("Mail Configuration") }}</v-subheader>
                        <v-card-text class="grey--text body-1">

                            <v-text-field :error-messages="errors.MAIL_DRIVER" name="MAIL_DRIVER" label="{{ __('Driver') }}" v-model="resource.item.MAIL_DRIVER"></v-text-field>

                            <v-text-field :error-messages="errors.MAIL_HOST" name="MAIL_HOST" label="{{ __('Host') }}" v-model="resource.item.MAIL_HOST"></v-text-field>

                            <v-text-field :error-messages="errors.MAIL_PORT" name="MAIL_PORT" label="{{ __('Port') }}" v-model="resource.item.MAIL_PORT"></v-text-field>

                            <v-text-field :error-messages="errors.MAIL_USERNAME" name="MAIL_USERNAME" label="{{ __('Username') }}" v-model="resource.item.MAIL_USERNAME"></v-text-field>

                            <v-text-field type="password" :error-messages="errors.MAIL_PASSWORD" name="MAIL_PASSWORD" label="{{ __('Password') }}" v-model="resource.item.MAIL_PASSWORD"></v-text-field>

                            <v-text-field :error-messages="errors.MAIL_ENCRYPTION" name="MAIL_ENCRYPTION" label="{{ __('Encryption') }}" v-model="resource.item.MAIL_ENCRYPTION"></v-text-field>

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
                    resource: {
                        item: {
                            MAIL_DRIVER: '{{ old('MAIL_DRIVER') ?? settings('MAIL_DRIVER', env('MAIL_DRIVER')) }}',
                            MAIL_HOST: '{{ old('MAIL_HOST') ?? settings('MAIL_HOST', env('MAIL_HOST')) }}',
                            MAIL_PORT: '{{ old('MAIL_PORT') ?? settings('MAIL_PORT', env('MAIL_PORT')) }}',
                            MAIL_USERNAME: '{{ old('MAIL_USERNAME') ?? settings('MAIL_USERNAME', env('MAIL_USERNAME')) }}',
                            MAIL_PASSWORD: '{{ old('MAIL_PASSWORD') ?? settings('MAIL_PASSWORD', env('MAIL_PASSWORD')) }}',
                            MAIL_FROM_NAME: '{{ old('MAIL_FROM_NAME') ?? settings('MAIL_FROM_NAME', env('MAIL_FROM_NAME')) }}',
                            MAIL_FROM_ADDRESS: '{{ old('MAIL_FROM_ADDRESS') ?? settings('MAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS')) }}',
                            MAIL_ENCRYPTION: '{{ old('MAIL_ENCRYPTION') ?? settings('MAIL_ENCRYPTION', env('MAIL_ENCRYPTION')) }}',
                        },
                    },
                    errors: {!! json_encode($errors->getMessages()) !!}
                };
            }
        });
    </script>
@endpush

