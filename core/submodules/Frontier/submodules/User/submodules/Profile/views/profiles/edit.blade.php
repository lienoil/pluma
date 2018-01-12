@extends("Theme::layouts.admin")

@section("head-title", __("Profile"))

@section("content")
    @include("Frontier::partials.banner")

    <v-parallax height="280" src="{{ $resource->setting('user_profile_banner', 'http://source.unsplash.com/1800x980?galaxy') }}" class="elevation-0">
        <div class="text-xs-right"><v-btn icon class="grey--text darken-1"><v-icon>photo_camera</v-icon></v-btn></div>
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

    <v-card class="elevation-1">
        <v-toolbar class="white elevation-0">
            <v-spacer></v-spacer>
        </v-toolbar>
    </v-card>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex md8 xs12 offset-md4>
                <form action="{{ route('profile.update', $resource->handlename) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <v-card>
                        <v-tabs dark fixed>
                            <v-tabs-bar class="purple lighten-2">
                                <v-tabs-slider class="purple darken-2"></v-tabs-slider>
                                <v-tabs-item class="body-1" href="about">{{ __('About') }}</v-tabs-item>
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
                                                    <v-text-field
                                                        label="{{ __('First name') }}"
                                                        name="firstname"
                                                        v-model="resource.firstname"
                                                    ></v-text-field>
                                                    <v-text-field
                                                        label="{{ __('Middle name') }}"
                                                        name="middlename"
                                                        v-model="resource.middlename"
                                                    ></v-text-field>
                                                    <v-text-field
                                                        label="{{ __('Last name') }}"
                                                        name="lastname"
                                                        v-model="resource.lastname"
                                                    ></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                            <v-layout row wrap>
                                                <v-flex xs4 class="grey--text body-1">
                                                    {{ __('Email Address') }}
                                                </v-flex>

                                                <v-flex xs8 class="body-1">
                                                    <v-text-field
                                                        label="{{ __('Email') }}"
                                                        name="email"
                                                        type="email"
                                                        v-model="resource.email"
                                                    ></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                            <v-subheader class="pl-0">Other Details</v-subheader>
                                            <v-layout row wrap>
                                                <v-flex xs4 class="grey--text body-1">
                                                    {{ __('Gender') }}
                                                </v-flex>

                                                <v-flex xs8 class="body-1">
                                                    <v-select label="{{ __('Gender') }}" v-model="resource.details.gender" :items="['Male', 'Female']"></v-select>
                                                    <input type="hidden" name="details[gender]" :value="resource.details.gender">
                                                </v-flex>
                                            </v-layout>
                                            <v-layout row wrap>
                                                <v-flex xs4 class="grey--text body-1">
                                                    {{ __('Birthday') }}
                                                </v-flex>

                                                <v-flex xs8 class="body-1">
                                                    <div class="input-group input-group--text-field">
                                                        <div class="input-group__input">
                                                            <input placeholder="MM/DD/YYYY" name="details[birthday]" tabindex="0" type="text" class="masked-input" :value="resource.details.birthday">
                                                        </div>
                                                        <div class="input-group__details">
                                                            <div class="input-group__messages"></div>
                                                        </div>
                                                    </div>
                                                </v-flex>
                                            </v-layout>
                                            <v-layout row wrap>
                                                <v-flex xs4 class="grey--text body-1">
                                                    {{ __('Home Address') }}
                                                </v-flex>

                                                <v-flex xs8 class="body-1">
                                                    <v-text-field
                                                        label="{{ __('Home Address') }}"
                                                        name="details[home_address]"
                                                        v-model="resource.details.home_address"
                                                    ></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                            <v-layout row wrap>
                                                <v-flex xs4 class="grey--text body-1">
                                                    {{ __('Phone Number') }}
                                                </v-flex>

                                                <v-flex xs8 class="body-1">
                                                    <v-text-field
                                                        label="{{ __('Phone Number') }}"
                                                        name="details[phone_number]"
                                                        v-model="resource.details.phone_number"
                                                    ></v-text-field>
                                                </v-flex>
                                            </v-layout>
                                        </v-card-text>
                                    </v-card>
                                </v-tabs-content>
                            </v-tabs-items>
                        </v-tabs>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn type="submit" primary>{{ __('Save') }}</v-btn>
                        </v-card-actions>
                    </v-card>
                </form>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        /*.overlay-bg {
            position: absolute;
            width: 100%;
            height: 100%;
            z-index: 0;
        }
        .media .card__text {
            z-index: 1;
        }
        .no--decoration {
            text-decoration: none;
        }*/
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ url('core/js/cleave.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                        firstname: '{{ old('firstname') ?? $resource->firstname }}',
                        middlename: '{{ old('middlename') ?? $resource->middlename }}',
                        lastname: '{{ old('lastname') ?? $resource->lastname }}',
                        email: '{{ old('email') ?? $resource->email }}',
                        details: {
                            gender: '{{ old('details.gender') ?? $resource->detail('gender') }}',
                            birthday: '{{ old('details.birthday') ?? $resource->detail('birthday') }}',
                            phone_number: '{{ old('details.phone_number') ?? $resource->detail('phone_number') }}',
                            home_address: '{{ old('details.home_address') ?? $resource->detail('home_address') }}',
                        }
                    }
                }
            },
            mounted () {
                let cleave = new Cleave('.masked-input', {
                    date: true,
                    datePattern: ['m', 'd', 'Y'],
                });
            }
        });
    </script>
@endpush
