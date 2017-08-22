@extends("Theme::layouts.admin")

@push('css')
    <style>
        .stickybar {
            position: -webkit-sticky;
            position: sticky;
            top: 64px;
            z-index: 99999;
        }
        .sticky {
            position: fixed;
        }
        .tabs__items {
            border: none;
        }
    </style>
@endpush

@section("content")

    <v-layout row wrap>
        <v-flex sm8 offset-sm2>
            @include("Theme::partials.banner")

            <form action="{{ route('users.store') }}" method="POST">
                {{ csrf_field() }}
                <v-card class="mb-3">
                    <v-toolbar card class="transparent">
                        <v-toolbar-title class="accent--text">{{ __($application->page->title) }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>

                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex md2>
                                <v-select
                                    :error-messages="resource.errors.roles"
                                    auto
                                    autocomplete
                                    item-text="text"
                                    item-value="value"
                                    label="{{ __('Prefix Name') }}"
                                    hide-details
                                    v-bind:items="[{text: 'None', value: null}, {text: 'Mr', value: 'Mr.'}, {text: 'Mrs', value: 'Mrs.'}, {text: 'Ms', value: 'Ms.'}]"
                                    name="prefixname"
                                    {{-- v-model="suppliments.roles.selected" --}}
                                ></v-select>
                                {{-- <v-text-field
                                    :error-messages="resource.errors.prefixname"
                                    label="{{ _('Prefix Name') }}"
                                    name="prefixname"
                                    value="{{ old('prefixname') }}"
                                    input-group
                                ></v-text-field> --}}
                            </v-flex>
                            <v-flex md3>
                                <v-text-field
                                    :error-messages="resource.errors.firstname"
                                    label="{{ _('First Name') }}"
                                    name="firstname"
                                    value="{{ old('firstname') }}"
                                    input-group
                                    {{-- @input="(val) => { resource.item.name = val; }" --}}
                                ></v-text-field>
                            </v-flex>
                            <v-flex md3>
                                <v-text-field
                                    :error-messages="resource.errors.middlename"
                                    label="{{ _('Middle Name') }}"
                                    name="middlename"
                                    value="{{ old('middlename') }}"
                                    input-group
                                    {{-- @input="(val) => { resource.item.name = val; }" --}}
                                ></v-text-field>
                            </v-flex>
                            <v-flex md4>
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
                            <v-flex sm6>
                                <v-text-field
                                    :error-messages="resource.errors.email"
                                    label="{{ _('Email') }}"
                                    name="email"
                                    value="{{ old('email') }}"
                                    input-group
                                ></v-text-field>
                            </v-flex>
                            <v-flex sm6>
                                <v-text-field
                                    :error-messages="resource.errors.username"
                                    label="{{ _('Username') }}"
                                    name="username"
                                    value="{{ old('username') }}"
                                    input-group
                                ></v-text-field>
                                <v-text-field
                                    :error-messages="resource.errors.password"
                                    label="{{ _('Password') }}"
                                    type="password"
                                    name="password"
                                    value="{{ old('password') }}"
                                    input-group
                                ></v-text-field>
                                <v-text-field
                                    :error-messages="resource.errors.password_confirmation"
                                    label="{{ _('Password Confirmation') }}"
                                    type="password"
                                    name="password_confirmation"
                                    value="{{ old('password_confirmation') }}"
                                    input-group
                                ></v-text-field>
                            </v-flex>
                        </v-layout>

                        <v-layout row wrap>
                            <v-flex sm6>
                                <p class="body-1"><strong>{{ __('Available Roles') }}</strong></p>
                                <v-dialog v-model="resource.dialog.model" hide-overlay transition="dialog-bottom-transition" scrollable persistent lazy width="100%" min-width="100%" height="100vh">
                                    <v-btn class="ma-0" flat slot="activator" info>{{ __('Select Available Roles...') }}</v-btn>
                                    <v-card height="100%">
                                        <v-toolbar card>
                                            <v-toolbar-title>{{ __('Roles') }}</v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            {{-- Search --}}
                                            <v-slide-y-transition>
                                                <v-text-field
                                                    append-icon="search"
                                                    label="{{ _('Search') }}"
                                                    single-line
                                                    hide-details
                                                    v-if="dataset.searchform.model"
                                                    v-model="dataset.searchform.query"
                                                    light
                                                ></v-text-field>
                                            </v-slide-y-transition>
                                            <v-btn v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" icon flat light @click.native="dataset.searchform.model = !dataset.searchform.model; dataset.searchform.query = '';">
                                                <v-icon>@{{ !dataset.searchform.model ? 'search' : 'clear' }}</v-icon>
                                            </v-btn>
                                            {{-- /Search --}}

                                            {{-- Close --}}
                                            <v-btn icon flat light @click.native="resource.dialog.model = false">
                                                <v-icon>clear</v-icon>
                                            </v-btn>
                                            {{-- /Close --}}
                                        </v-toolbar>
                                        <v-data-table
                                            :loading="dataset.loading"
                                            :total-items="dataset.totalItems"
                                            class="elevation-0"
                                            no-data-text="{{ _('No resource found') }}"
                                            select-all
                                            selected-key="id"
                                            v-bind:headers="dataset.headers"
                                            v-bind:items="dataset.items"
                                            v-bind:pagination.sync="dataset.pagination"
                                            v-model="dataset.selected"
                                        >
                                            <template slot="items" scope="prop">
                                                <td>
                                                    <v-checkbox
                                                        primary
                                                        hide-details
                                                        class="pa-0"
                                                        v-model="prop.selected"
                                                    ></v-checkbox>
                                                </td>
                                                <td>
                                                    <strong v-tooltip:bottom="{'html': prop.item.displayname ? prop.item.displayname : prop.item.propername}">@{{ prop.item.name }}</strong>
                                                </td>
                                                <td>@{{ prop.item.code }}</td>
                                                <td>
                                                    <template v-if="prop.item.grants" v-for="(grant, i) in prop.item.grants">
                                                        <span>@{{ grant.name }} <template v-if="(i+1) < prop.item.grants.length">, </template></span>
                                                    </template>
                                                </td>
                                            </template>
                                        </v-data-table>

                                        <v-card-actions bottom>
                                            <v-spacer></v-spacer>
                                            <v-btn flat primary @click.native="resource.dialog.model = false">{{ __('Accept') }}</v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-flex>
                            <v-flex sm6>
                                <p class="body-1"><strong>{{ __('Roles Chosen') }}</strong></p>
                                <p v-if="dataset.selected.length <= 0" class="grey--text">{{ __("Roles you've assigned to this user will appear here.") }}</p>
                                <template v-if="dataset.selected.length" v-for="(role, i) in dataset.selected">
                                    <v-slide-y-transition>
                                        <p class="subheading">
                                            <strong>@{{ role.alias }}</strong>
                                            <br>
                                            <span class="grey--text">@{{ role.code }}</span>
                                            <v-btn flat icon @click.native="dataset.selected.splice(i, 1)"><v-icon>close</v-icon></v-btn>
                                            <input type="hidden" name="roles[]" :value="role.id">
                                        </p>
                                    </v-slide-y-transition>
                                </template>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn primary type="submit">{{ _('Submit') }}</v-btn>
                    </v-card-actions>
                </v-card>
            </form>
        </v-flex>
    </v-layout>
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
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                        dialog: {
                            model: false,
                        },
                    },
                    suppliments: {
                        roles: {
                            items: [],
                            selected: [],
                        }
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
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy,
                        take: rowsPerPage,
                    };
                    this.api().get('{{ route('api.roles.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                this.get();
                // this.mountSuppliments();
                // console.log("dataset.pagination", this.dataset.pagination);
            },
        });
    </script>
@endpush


