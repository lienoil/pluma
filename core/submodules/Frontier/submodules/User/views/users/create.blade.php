@extends("Theme::layouts.admin")

@section("content")

    <v-container grid-list-lg>

        @include("Theme::partials.banner")

        <form action="{{ route('users.store') }}" method="POST">
            {{ csrf_field() }}

            <v-layout row wrap>
                <v-flex sm9>

                    <v-card class="mb-3 elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title class="accent--text">{{ __($application->page->title) }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <v-switch
                                label="{{ __('Show required fields only') }}"
                                v-model="suppliments.required_fields.model"
                                value
                                right
                                @click.native="setStorage('settings.show_required_fields_only', (suppliments.required_fields.model))"
                            ></v-switch>
                        </v-toolbar>

                        <v-subheader>{{ __('Basic Information') }}</v-subheader>
                        <v-card-text>
                            <v-layout row wrap>
                                <v-flex xs2 v-show="!suppliments.required_fields.model">
                                    <v-select
                                        :error-messages="resource.errors.prefix"
                                        prepend-icon="account_box"
                                        item-text="text"
                                        item-value="value"
                                        hide-details
                                        label="{{ __('Prefix') }}"
                                        v-model="resource.item.prefixname"
                                        v-bind:items="[{text: '{{ __('None') }}', value: null}, {text: '{{ __('Mr') }}', value: '{{ __('Mr.') }}'}, {text: '{{ __('Mrs') }}', value: '{{ __('Mrs.') }}'}, {text: '{{ __('Ms') }}', value: '{{ __('Ms.') }}'}]"
                                    ></v-select>
                                    <input type="hidden" name="prefixname" :v-model="resource.item.prefixname">
                                </v-flex>
                                <v-flex
                                    v-bind="suppliments.required_fields.model?{[`xs6`]:true}:{[`xs3`]:true}"
                                >
                                    <v-text-field
                                        :prepend-icon="suppliments.required_fields.model?'account_box':''"
                                        :error-messages="resource.errors.firstname"
                                        label="{{ _('First Name') }}"
                                        name="firstname"
                                        v-model="resource.item.firstname"
                                        input-group
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs3 v-show="!suppliments.required_fields.model">
                                    <v-text-field
                                        :error-messages="resource.errors.middlename"
                                        label="{{ _('Middle Name') }}"
                                        name="middlename"
                                        v-model="resource.item.middlename"
                                        input-group
                                    ></v-text-field>
                                </v-flex>
                                <v-flex
                                    v-bind="suppliments.required_fields.model?{[`xs6`]:true}:{[`xs4`]:true}"
                                >
                                    <v-text-field
                                        :error-messages="resource.errors.lastname"
                                        label="{{ _('Last Name') }}"
                                        name="lastname"
                                        v-model="resource.item.lastname"
                                        input-group
                                        {{-- @input="(val) => { resource.item.name = val; }" --}}
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-card-text>
                        <v-subheader>{{ __('Account') }}</v-subheader>
                        <v-card-text>
                            <v-layout row wrap>
                                <v-flex xs12>
                                    <v-select
                                        :error-messages="resource.errors.roles"
                                        :items="suppliments.roles.items"
                                        autocomplete
                                        clearable
                                        hint="{{ __('You may assign multiple roles to this user') }}"
                                        item-text="name"
                                        item-value="id"
                                        label="{{ __('Roles') }}"
                                        multiple
                                        persistent-hint
                                        prepend-icon="supervisor_account"
                                        v-model="suppliments.roles.selected"
                                    ></v-select>
                                    <input type="hidden" name="roles[]" :value="id" v-for="(id, i) in suppliments.roles.selected" :key="i">


                                    <v-text-field
                                        :error-messages="resource.errors.email"
                                        input-group
                                        label="{{ _('Email') }}"
                                        name="email"
                                        prepend-icon="email"
                                        type="email"
                                        v-model="resource.item.email"
                                    ></v-text-field>
                                    <v-text-field
                                        :error-messages="resource.errors.username"
                                        label="{{ _('Username') }}"
                                        name="username"
                                        v-model="resource.item.username"
                                        prepend-icon="account_circle"
                                        input-group
                                    ></v-text-field>
                                    <v-text-field
                                        :error-messages="resource.errors.password"
                                        label="{{ _('Password') }}"
                                        type="password"
                                        name="password"
                                        v-model="resource.item.password"
                                        prepend-icon="lock"
                                        input-group
                                    ></v-text-field>
                                    <v-text-field
                                        :error-messages="resource.errors.password"
                                        label="{{ _('Password Confirmation') }}"
                                        type="password"
                                        name="password_confirmation"
                                        v-model="resource.item.password_confirmation"
                                        prepend-icon="lock_open"
                                        input-group
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-card-text>

                        <v-subheader v-show="!suppliments.required_fields.model">{{ __('Background Details') }}</v-subheader>
                        <v-card-text v-show="!suppliments.required_fields.model">
                            <v-layout row wrap>
                                <v-flex xs12>
                                    <v-radio-group v-model="resource.item.details.gender" :mandatory="false">
                                        <v-radio label="{{ __('Male') }}"
                                            color="blue"
                                            value="Male"
                                            hide-details></v-radio>
                                        <v-radio label="{{ __('Female') }}"
                                            color="pink"
                                            value="Female"
                                            hide-details></v-radio>
                                    </v-radio-group>
                                    <input type="hidden" name="details[gender]" :value="resource.item.details.gender">

                                    {{-- <input type="text" class="cleavable date-format"> --}}
                                    <v-text-field
                                        :error-messages="resource.errors['details.birthday']"
                                        class="cleavable date-format"
                                        hint="{{ __('YYYY/MM/DD') }}"
                                        label="{{ __('Birthday') }}"
                                        name="details[birthday]"
                                        persistent-hint
                                        prepend-icon="fa-birthday-cake"
                                        v-model="resource.item.details.birthday"
                                    ></v-text-field>

                                    <v-text-field
                                        :error-messages="resource.errors['details.address']"
                                        input-group
                                        label="{{ _('Address') }}"
                                        name="details[address]"
                                        prepend-icon="map"
                                        v-model="resource.item.details.address"
                                        v-show="!suppliments.required_fields.model"
                                    ></v-text-field>

                                    <v-text-field
                                        :error-messages="resource.errors.phone"
                                        class="cleavable phone-format"
                                        hint="{{ __('International Format') }}"
                                        input-group
                                        label="{{ _('Phone') }}"
                                        name="details[phone]"
                                        persistent-hint
                                        prepend-icon="phone"
                                        v-model="resource.item.details.phone"
                                        v-show="!suppliments.required_fields.model"
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-card-text>

                        {{-- <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn primary type="submit" class="elevation-1">{{ _('Submit') }}</v-btn>
                        </v-card-actions> --}}
                    </v-card>
                </v-flex>
                <v-flex sm3>

                    {{-- Avatar --}}
                    @include("Theme::cards.avatar")
                    {{-- Avatar --}}

                    {{-- Save --}}
                    @include("Theme::cards.saving")
                    {{-- /Save --}}

                </v-flex>
            </v-layout>
        </form>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script src="{{ assets('frontier/js/cleave.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            prefixname: '{{ old('prefixname') }}',
                            firstname: '{{ old('firstname') }}',
                            middlename: '{{ old('middlename') }}',
                            lastname: '{{ old('lastname') }}',
                            email: '{{ old('email') }}',
                            username: '{{ old('username') }}',
                            password: '{{ old('password') }}',
                            password_confirmation: '{{ old('password_confirmation') }}',
                            details: {
                                gender: '{{ old('details.gender') }}',
                                birthday: '{{ old('details.birthday') }}',
                                address: '{{ old('details.address') }}',
                                phone: '{{ old('details.phone') }}',
                            },
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    suppliments: {
                        roles: {
                            headers: [
                                { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                                { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                                { text: '{{ __("Description") }}', align: 'left', value: 'description' },
                            ],
                            pagination: {
                                rowsPerPage: '{{ settings('items_per_page', 15) }}',
                                totalItems: 0,
                            },
                            items: [],
                            selected: [],
                            searchform: {
                                query: '',
                                model: true,
                            }
                        },
                        avatars: {
                            selected: {!! json_encode($avatars[0]) !!},
                            items: {!! json_encode($avatars) !!}
                        },
                        required_fields: {
                            model: false,
                        },
                    },
                    urls: {
                        roles: {
                            show: '{{ route('roles.show', 'null') }}',
                            edit: '{{ route('roles.edit', 'null') }}',
                            destroy: '{{ route('roles.destroy', 'null') }}',
                        },
                    },
                };
            },

            methods: {
                mountSuppliments () {
                    let items = {!! json_encode($roles) !!};
                    let g = [];
                    for (var i in items) {
                        g.push({
                            id: items[i].id,
                            name: items[i].name,
                            code: items[i].code,
                            description: items[i].description,
                        });
                    }
                    this.suppliments.roles.items = g;

                    let selected = {!! json_encode(old('roles')) !!};
                    let s = [];
                    if (selected) {
                        for (var i in selected) {
                            for (var j = items.length - 1; j >= 0; j--) {
                                if (selected[i] == items[j].id) {
                                    let instance = items[j];
                                    s.push({
                                        id: instance.id,
                                        name: instance.name,
                                    });
                                }
                            }
                        }
                    }
                    this.suppliments.roles.selected = s ? s : [];
                },

                getStorageData() {
                    this.suppliments.required_fields.model = this.getStorage('settings.show_required_fields_only') == 'true';
                },
            },

            mounted () {
                this.mountSuppliments();
                this.getStorageData();

                // Cleave
                var cleave = new Cleave('.cleavable.date-format input', {
                    date: true,
                    datePattern: ['Y', 'm', 'd']
                });
                new Cleave('.cleavable.phone-format input', {
                    prefix: '+',
                    numeral: true,
                    numeralDecimalMark: '.',
                    delimiter: '',
                    blocks: [15],
                });

                // this.mountSuppliments();
                // console.log("dataset.pagination", this.dataset.pagination);
            },
        });
    </script>
@endpush


