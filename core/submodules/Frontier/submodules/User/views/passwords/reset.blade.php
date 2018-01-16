@extends("Theme::layouts.auth")

@section("content")
    <main id="main" class="main">
        <v-container fluid fill-height>
            <v-layout fill-height column wrap justify-center align-center>
                <v-flex lg6 md10 sm10 xs12 fill-height justify-center align-center>

                    @include("Theme::partials.banner")

                    <v-card class="elevation-1 mb-3">
                        <v-layout row wrap>
                            <v-flex md5 xs12 class="pink darken-1">
                                <v-layout row wrap justify-center align-center>
                                    <v-flex xs12>
                                        <v-card class="elevation-0 transparent white--text" height="100%">
                                            <v-card-text class="text-xs-center">
                                                <v-layout row wrap justify-center align-center>
                                                    <v-flex xs12>
                                                        <p><img src="{{ settings('login_logo', assets('user/images/password/pw-reset.png')) }}" alt="{{ __('Lock and key image') }}" width="180"></p>
                                                        <h4>{{ "New Password" }}</h4>
                                                        <p>{{ __("You are setting up a new password.") }}</p>
                                                    </v-flex>
                                                </v-layout>
                                            </v-card-text>
                                        </v-card>
                                    </v-flex>
                                </v-layout>
                            </v-flex>
                            <v-flex md7 xs12>
                                <form action="{{ route('password.reset') }}" method="POST">
                                    {{ csrf_field() }}
                                    <v-card tile flat transition="slide-x-transition" height="500px">
                                        <v-toolbar card class="white">
                                            <img class="brand-logo" width="30" class="mt-2" avatar src="{{ $application->site->logo }}" alt="{{ $application->site->title }}"/>
                                            <v-toolbar-title class="brand-type grey--text text--darken-1">
                                                {{ $application->page->title }}
                                            </v-toolbar-title>
                                            <v-spacer></v-spacer>
                                        </v-toolbar>
                                        <v-divider></v-divider>
                                        <v-card-text>
                                            <v-card flat>
                                                <v-card-text class="pa-0">
                                                	<input type="hidden" name="token" value="{{ $token }}">
                                                    <v-text-field
                                                        :error-messages="resource.errors.email"
                                                        name="email"
                                                        type="email"
                                                        label="{{ __('Email') }}"
                                                        :value="resource.item.email"
                                                    ></v-text-field>
                                                    <v-text-field
                                                    	:error-messages="resource.errors.password"
                                                    	name="password"
                                                    	type="password"
                                                        label="{{ __('New Password') }}"
                                                        :value="resource.item.password"
                                                    ></v-text-field>
                                                    <v-text-field
                                                    	:error-messages="resource.errors.password_confirmation"
                                                    	name="password_confirmation"
                                                    	type="password"
                                                        label="{{ __('Confirm New Password') }}"
                                                        :value="resource.item.password_confirmation"
                                                    ></v-text-field>
                                                </v-card-text>
                                                <v-card-actions>
                                                    <v-btn role="button" class="pink darken-1 white--text elevation-1 mx-0" type="submit">{{ __("Reset Password") }}</v-btn>
                                                	<v-spacer></v-spacer>
                                                </v-card-actions>
                                            </v-card>

                                        </v-card-text>
                                    </v-card>
                                </form>

                                @stack('post-login')
                            </v-flex>
                        </v-layout>
                    </v-card>

                </v-flex>
            </v-layout>
        </v-container>
    </main>

@endsection

@push('pre-scripts')
	<script>
		mixins.push({
			data () {
				return {
					resource: {
						item: {
                            email: '{{ $email ?? old('email') }}',
							password: '{{ old('password') }}',
							password_confirmation: '{{ old('password_confirmation') }}',
						},
						errors: {!! json_encode($errors->getMessages()) !!},
					}
				}
			}
		})
	</script>
@endpush
