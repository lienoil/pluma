@extends("Theme::layouts.admin")

@section("content")

    <v-container fluid grid-list-lg>
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
                                        auto
                                        autocomplete
                                        prepend-icon="account_box"
                                        item-text="text"
                                        item-value="value"
                                        label="{{ __('Prefix Name') }}"
                                        v-model="resource.prefixname.model"
                                        v-bind:items="[{text: '{{ __('None') }}', value: null}, {text: '{{ __('Mr') }}', value: '{{ __('Mr.') }}'}, {text: '{{ __('Mrs') }}', value: '{{ __('Mrs.') }}'}, {text: '{{ __('Ms') }}', value: '{{ __('Ms.') }}'}]"
                                    ></v-select>
                                    <input type="hidden" name="prefixname" :value="resource.prefixname.model">
                                </v-flex>
                                <v-flex
                                    v-bind="suppliments.required_fields.model?{[`xs6`]:true}:{[`xs3`]:true}"
                                >
                                    <v-text-field
                                        :prepend-icon="suppliments.required_fields.model?'account_box':''"
                                        :error-messages="resource.errors.firstname"
                                        label="{{ _('First Name') }}"
                                        name="firstname"
                                        value="{{ old('firstname') }}"
                                        input-group
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs3 v-show="!suppliments.required_fields.model">
                                    <v-text-field
                                        :error-messages="resource.errors.middlename"
                                        label="{{ _('Middle Name') }}"
                                        name="middlename"
                                        value="{{ old('middlename') }}"
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
                                        value="{{ old('lastname') }}"
                                        input-group
                                        {{-- @input="(val) => { resource.item.name = val; }" --}}
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                            <v-layout row wrap>
                                <v-flex xs12>
                                    <v-text-field
                                        :error-messages="resource.errors.email"
                                        label="{{ _('Email') }}"
                                        name="email"
                                        prepend-icon="email"
                                        value="{{ old('email') }}"
                                        input-group
                                    ></v-text-field>
                                    <v-text-field
                                        :error-messages="resource.errors.username"
                                        label="{{ _('Username') }}"
                                        name="username"
                                        value="{{ old('username') }}"
                                        prepend-icon="account_circle"
                                        input-group
                                    ></v-text-field>
                                    <v-text-field
                                        :error-messages="resource.errors.password"
                                        label="{{ _('Password') }}"
                                        type="password"
                                        name="password"
                                        value="{{ old('password') }}"
                                        prepend-icon="lock"
                                        input-group
                                    ></v-text-field>
                                    <v-text-field
                                        :error-messages="resource.errors.password"
                                        label="{{ _('Password Confirmation') }}"
                                        type="password"
                                        name="password_confirmation"
                                        value="{{ old('password_confirmation') }}"
                                        prepend-icon="lock_open"
                                        input-group
                                    ></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-card-text>

                        <v-layout row wrap>
                            <v-flex xs6>
                                <v-toolbar class="transparent elevation-0">
                                    <v-toolbar-title class="body-1">{{ __('Available Roles') }}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-text-field
                                        append-icon="search"
                                        label="{{ _('Search') }}"
                                        single-line
                                        hide-details
                                        v-model="suppliments.roles.searchform.query"
                                        light
                                    ></v-text-field>
                                </v-toolbar>

                                <v-data-table
                                    class="elevation-0"
                                    no-data-text="{{ _('No resource found') }}"
                                    select-all="primary"
                                    selected-key="id"
                                    {{-- hide-actions --}}
                                    v-bind:search="suppliments.roles.searchform.query"
                                    v-bind:headers="suppliments.roles.headers"
                                    v-bind:items="suppliments.roles.items"
                                    v-model="suppliments.roles.selected"
                                    v-bind:pagination.sync="suppliments.roles.pagination"
                                >
                                    <template slot="items" scope="prop">
                                        <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                                            <td>
                                                <v-checkbox
                                                color="primary"
                                                    hide-details
                                                    class="pa-0"
                                                    :input-value="prop.selected"
                                                ></v-checkbox>
                                            </td>
                                            <td>@{{ prop.item.name }}</td>
                                            <td>@{{ prop.item.code }}</td>
                                            <td>@{{ prop.item.description }}</td>
                                        </tr>
                                    </template>
                                </v-data-table>
                            </v-flex>
                            <v-flex xs6>
                                <v-subheader>{{ __('Selected Roles') }}</v-subheader>
                                <v-card-text class="text-xs-center">
                                    <template v-if="suppliments.roles.selected.length">
                                        <template v-for="(grant, i) in suppliments.roles.selected">
                                            <v-chip
                                                width="100px"
                                                label
                                                close
                                                success
                                                @click.native.stop
                                                @input="suppliments.roles.selected.splice(i, 1)"
                                                class="chip--select-multi pink darken-3 white--text"
                                                :key="i"
                                            >
                                                <input type="hidden" name="roles[]" :value="grant.id">
                                                @{{ grant.name }}
                                            </v-chip>
                                        </template>
                                    </template>
                                    <small v-else class="grey--text">{{ __('No chosen Roles') }}</small>
                                </v-card-text>
                            </v-flex>
                        </v-layout>

                        <v-subheader v-show="!suppliments.required_fields.model">{{ __('Details') }}</v-subheader>
                        <v-card-text v-show="!suppliments.required_fields.model">
                            <v-layout row wrap>
                                <v-flex xs12>
                                    <v-radio-group v-model="resource.gender.model" :mandatory="false">
                                        <v-radio label="{{ __('Male') }}"
                                            color="blue"
                                            value="Male"
                                            hide-details></v-radio>
                                        <v-radio label="{{ __('Female') }}"
                                            color="pink"
                                            value="Female"
                                            hide-details></v-radio>
                                        <input type="hidden" name="gender" :value="resource.gender.model">
                                    </v-radio-group>

                                    <v-menu
                                        v-show="!suppliments.required_fields.model"
                                        lazy
                                        :close-on-content-click="false"
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        :nudge-left="40"
                                        max-width="290px"
                                    >
                                        <v-text-field
                                            slot="activator"
                                            label="{{ __('Birthday') }}"
                                            v-model="resource.birthday.formatted"
                                            prepend-icon="fa-birthday-cake"
                                            name="birthday"
                                            value="{{ old('birthday') }}"
                                            readonly
                                        ></v-text-field>
                                            <v-date-picker
                                                v-model="resource.birthday.value"
                                                scrollable
                                                actions
                                                :date-format="date => new Date(date).toDateString()"
                                                :formatted-value.sync="resource.birthday.formatted"
                                            >
                                            <template scope="{ save, cancel }">
                                                <v-card-actions>
                                                    <v-btn flat primary @click.native="cancel()">Cancel</v-btn>
                                                    <v-btn flat primary @click.native="save()">Save</v-btn>
                                                </v-card-actions>
                                            </template>
                                        </v-date-picker>
                                    </v-menu>

                                    <v-text-field
                                        v-show="!suppliments.required_fields.model"
                                        :error-messages="resource.errors.address"
                                        label="{{ _('Address') }}"
                                        prepend-icon="map"
                                        name="address"
                                        value="{{ old('address') }}"
                                        input-group
                                    ></v-text-field>
                                    <v-text-field
                                        v-show="!suppliments.required_fields.model"
                                        :error-messages="resource.errors.phone"
                                        label="{{ _('Phone') }}"
                                        prepend-icon="phone"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        input-group
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
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    dataset: {
                        headers: [
                            { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                            { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                            { text: '{{ __("Grants") }}', align: 'left', value: 'grants' },
                        ],
                        items: [],
                        loading: true,
                        pagination: {
                            rowsPerPage: 5,
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: {!! json_encode(old('roles')) !!} ? {!! json_encode(old('roles')) !!} : [],
                        totalItems: 0,
                    },
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            grants: '',
                        },
                        prefixname: {
                            model: '',
                        },
                        birthday: {
                            value: '',
                            formatted: '{{ old('birthday') }}',
                        },
                        notify: {
                            model: false,
                        },
                        status: {
                            model: true,
                        },
                        status_range: {
                            model: '',
                        },
                        gender: {
                            model: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        dialog: {
                            model: false,
                        },
                    },
                    suppliments: {
                        roles: {
                            headers: [
                                { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                                { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                                { text: '{{ __("Description") }}', align: 'left', value: 'description' },
                            ],
                            pagination: {
                                rowsPerPage: 10,
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

            watch: {
                'dataset.pagination': {
                    handler () {
                        this.get();
                    },
                    deep: true
                },

                'dataset.searchform.query': function (filter) {
                    setTimeout(() => {
                        const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            q: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.roles.search') }}', query)
                            .then((data) => {
                                this.dataset.items = data.items.data ? data.items.data : data.items;
                                this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                                this.dataset.loading = false;
                            });
                    }, 1000);
                },
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
                // this.mountSuppliments();
                // console.log("dataset.pagination", this.dataset.pagination);
            },
        });
    </script>
@endpush


