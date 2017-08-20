@extends("Install::layouts.installation")

@section("head-title", $application->pluma->title)
@section("head-subtitle", "| " . $application->pluma->tagline)

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid>
        <v-layout row wrap>
            <v-flex sm8 md6 offset-sm2 offset-md3>
                <v-card class="mt-4 mb-3 elevation-1 grey--text">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="headline primary--text">{!! $application->site->title !!} | {{ $application->site->tagline }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <h3 class="headline grey--text">{{ __('Almost There') }}</h3>
                        <p class="subheading">{!! __('Successfully finished writing and migrating data!') !!}</p>
                        <p>{!! __('Below, specify your sites <code>Superadmin</code>. It will then also seed your database with other default settings.') !!}</p>
                    </v-card-text>

                    <form action="{{ route('installation.store') }}" method="POST">
                        {{ csrf_field() }}
                        <v-card-text>
                            <legend><strong>{{ __('Superadmin') }}</strong></legend>
                            <p class="grey--text">{{ __("The account you will be creating below is not removable from the application's dashboard.") }}</p>
                            <v-text-field
                                :error-messages="resource.errors.email"
                                label="{{ __('Email') }}"
                                name="email"
                                input-group
                                type="email"
                                value="{{ old('email') ? old('email') : env('MAIL_USERNAME') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.password"
                                label="{{ __('Password') }}"
                                name="password"
                                input-group
                                type="password"
                                value="{{ old('password') }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.password_confirmation"
                                label="{{ __('Password Confirmation') }}"
                                name="password_confirmation"
                                input-group
                                type="password"
                                value="{{ old('password_confirmation') }}"
                            ></v-text-field>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Create') }}</v-btn>
                        </v-card-actions>
                    </form>
                </v-card>
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
                        item: [],
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                };
            },
        });
    </script>
@endpush
