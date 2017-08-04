@extends("Frontier::layouts.admin")

@push("utilitybar")
    {{-- <v-progress-linear buffer v-if="loading" class="ma-0" v-bind:indeterminate="true"></v-progress-linear> --}}
    {{-- @include("Frontier::partials.loading") --}}
@endpush

@push("page-settings")
    <v-card>
        <v-card-text>
            <h5 class="headline">
                <v-icon>{{ $application->page->icon }}</v-icon>
                {{ __($application->page->title) }}
            </h5>
            <p class="grey--text">{{ __("Grants are sets of permissions grouped together for convenience.") }}</p>
        </v-card-text>
    </v-layout>
@endpush

@section("content")
    <v-layout row wrap>
        <v-flex sm5>
            <form action="{{ route('grants.store') }}" method="POST">
                {{ csrf_field() }}
                <v-card class="lighten-4 grey--text elevation-1 mb-2">
                    <v-toolbar class="primary lighten-2 elevation-0">
                        <v-toolbar-title class="white--text">{{ __('Add Grant') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                            required
                            name="name"
                            label="Name"
                            value="{{ old('name') }}"
                        ></v-text-field>
                        <v-text-field
                            required
                            name="code"
                            label="Code"
                            value="{{ old('code') }}"
                            hint="No special characters nor spaces"
                        ></v-text-field>
                        <v-text-field
                            name="description"
                            label="Description"
                            value="{{ old('description') }}"
                        ></v-text-field>
                    </v-card-text>
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-card class="elevation-0">
                                <v-card-text class="grey--text text--darken-2 grey lighten-5">
                                    {{ __('Permissions') }}
                                    <v-spacer></v-spacer>
                                </v-card-text>
                                <v-card-text v-if="grant">
                                    <v-data-table
                                        {{-- v-bind:headers="headers" --}}
                                        v-bind:items="grant.permissions"
                                        select-all
                                        {{-- v-bind:pagination.sync="pagination" --}}
                                        {{-- :total-items="grant.permissions.total" --}}
                                        {{-- :loading="loading" --}}
                                        selected-key="name"
                                        class="elevation-0"
                                    ></v-data-table>
                                    {{-- <p v-for="(permission, i) in grant.permissions">@{{ permission.code }}</p> --}}
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                    <v-card-text>
                        <button type="submit" class="btn btn--raised primary">{{ __('Submit') }}</button>
                    </v-card-text>
                </v-card>
            </form>
        </v-flex>
        <v-flex sm7>
            <v-card>
                <v-toolbar light class="elevation-0">
                    <v-toolbar-title class="grey--text text--darken-2">{{ __('All Grants') }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <template v-for="tool in quicktools.items">
                        <v-btn
                            icon
                            v-model="tool.model"
                            :title="tool.description"
                            v-tooltip:left="{'html': tool.description}"
                            @click.native="tool.callback ? tool.callback() : (tool.model = !tool.model)"
                        ><v-icon :class="tool.toggle && tool.model ? 'primary--text' : 'grey--text'">@{{ tool.icon }}</v-icon></v-btn>
                    </template>
                </v-toolbar>
                <v-data-table
                    v-bind:headers="headers"
                    v-bind:items="grants?grants.data:[]"
                    select-all
                    v-bind:pagination.sync="pagination"
                    :total-items="totalItems"
                    :loading="loading"
                    selected-key="id"
                    class="elevation-0"
                >
                    <template slot="headerCell" scope="props">
                        <span v-tooltip:bottom="{'html': props.header.text}">
                            @{{ props.header.text }}
                        </span>
                    </template>
                    <template slot="items" scope="props">
                        <tr :active="props.selected" @click="props.selected = !props.selected">
                            <td>
                                <v-checkbox
                                    primary
                                    hide-details
                                    :input-value="props.selected"
                                ></v-checkbox>
                            </td>
                            <td>@{{ props.item.id }}</td>
                            <td
                                v-tooltip:right="{'html': props.item.description}"
                            >
                                {{-- @{{ props.item.name }} --}}
                                <v-edit-dialog
                                    v-if="quicktools.items.edit.model"
                                    @open="props.item._name = props.item.name"
                                    @cancel="props.item.name = props.item._name || props.item.name"
                                    @save="putGrant(props.item)"
                                    lazy
                                    large
                                    role="button"
                                    transition="scale-transition"
                                >
                                    @{{ props.item.name }}
                                    <v-text-field
                                        slot="input"
                                        label="Edit"
                                        v-bind:value="props.item.name"
                                        single-line
                                        @change="val => props.item.name = val"
                                        @keyup.esc="props.item.name = props.item._name || props.item.name"
                                    ></v-text-field>
                                </v-edit-dialog>
                                <template v-else>@{{ props.item.name }}</template>
                            </td>
                            <td>
                                <v-edit-dialog
                                    v-if="quicktools.items.edit.model"
                                    @open="props.item._code = props.item.code"
                                    @cancel="props.item.code = props.item._code || props.item.code"
                                    @save="putGrant(props.item)"
                                    lazy
                                    large
                                    role="button"
                                    transition="scale-transition"
                                >
                                    @{{ props.item.code }}
                                    <v-text-field
                                        slot="input"
                                        label="Edit"
                                        v-bind:value="props.item.code"
                                        single-line
                                        @change="val => props.item.code = val"
                                        @keyup.esc="props.item.code = props.item._code || props.item.code"
                                    ></v-text-field>
                                </v-edit-dialog>
                                <template v-else>@{{ props.item.code }}</template>
                            </td>
                            <td class="text-xs-right">@{{ props.item.permissions.length }}</td>
                            <td>
                                <div class="text-xs-center">
                                    <a role="button" class="btn btn--icon btn--raised" href="{{ route('grants.edit', 1) }}" icon v-tooltip:left="{'html': 'Edit'}"><div class="btn__content"><v-icon>edit</v-icon></div></a>
                                    <v-btn
                                        @click.native="removeGrant(props.item)"
                                        icon
                                        v-tooltip:left="{'html': 'Delete'}"
                                    >
                                        <v-icon>delete</v-icon>
                                    </v-btn>
                                </div>
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </v-card>
        </v-flex>
    </v-layout>

@endsection

@push('pre-scripts')
    {{-- <script src="{{ assets('frontier/vendor/vue/resource/vue-resource.min.js') }}"></script> --}}
    {{-- <script src="{{ present('frontier/components/Draggable/dist/vuedraggable.min.js') }}"></script> --}}
    <script>
        /**
         * ---------------------------------------
         * Imports
         * ---------------------------------------
         * Browser friendly imports
         */
        // Vue.use(VueResource);
        // Vue.use(VueDraggable);

        /**
         * ---------------------------------------
         * Variables
         * ---------------------------------------
         *
         * @type {String}
         */
        //

        /**
         * ---------------------------------------
         * Mixins Push
         * ---------------------------------------
         * Lets you push data, methods, etc to
         * existing Vue instance.
         *
         */
        mixins.push({
            data () {
                return {
                    quicktools: {
                        model: null,
                        items: {
                            refresh: {
                                model: null,
                                icon: 'refresh',
                                description: '{{ __("Refresh List") }}',
                                callback: () => { this.getAllGrants() },
                            },
                            edit: {
                                toggle: true,
                                model: false,
                                icon: 'edit',
                                description: '{{ __("Toggle Quick Edit") }}',
                            },
                            delete: {
                                model: null,
                                icon: 'delete',
                                description: '{{ __("Remove Many") }}',
                            },
                        },
                    },
                    loading: true,
                };
            },

            mounted () {
                // this.initializeSelects();
                // this.getDataFromApi()
                //     .then(data => {
                //         this.grants = data.items
                //         this.totalItems = data.total
                //     });
            },

            methods: {

                getDataFromApi () {
                    this.setLoading(true);
                    return new Promise((resolve, reject) => {
                        const { sortBy, descending, page, rowsPerPage } = this.pagination;

                        let items = this.getAllGrants();
                        const total = items.length;

                        if (items && this.pagination.sortBy) {
                            items = items.sort((a, b) => {
                                const sortA = a[sortBy];
                                const sortB = b[sortBy];

                                if (descending) {
                                    if (sortA < sortB) return 1;
                                    if (sortA > sortB) return -1;
                                    return 0;
                                } else {
                                    if (sortA < sortB) return -1;
                                    if (sortA > sortB) return 1;
                                    return 0;
                                }
                            });
                        }

                        if (items && rowsPerPage > 0) {
                            items = items.slice((page - 1) * rowsPerPage, page * rowsPerPage);
                        }

                        setTimeout(() => {
                            this.setLoading(false);
                            resolve({
                                items,
                                total
                            });
                        }, 1000);
                    });
                },

                postGrant (data) {
                    let self = this;
                    let url = '{{ route('api.grants.store') }}';

                    self.setLoading(true);

                    this.$http.post(url, data).then(response => {
                        let res = response.data;
                        self.snackbar.model = true;//(data.message, data.success);
                        self.snackbar.context = res.context;
                        self.snackbar.text = res.text;

                        self.setLoading(false);

                        setTimeout(() => {
                            self.getAllGrants();
                        }, 800);
                    });
                },

                putGrant (data) {
                    let self = this;
                    let url = '{{ route('api.grants.update') }}';

                    self.setLoading(true);
                    // data.name = data._name;
                    // alert(JSON.stringify(data));

                    setTimeout(() => {
                        this.$http.put(url, data).then(response => {
                            let res = response.data;
                            self.snackbar.model = true;//(data.message, data.success);
                            self.snackbar.context = res.context;
                            self.snackbar.text = res.text;

                            self.setLoading(false);
                        });
                    }, 800);
                },

                removeGrant (grant) {
                    // confirm('are you sure remioved?');
                    let self = this;
                    let url = '{{ route('api.grants.remove', '') }}' + '/' + grant.id;

                    self.setLoading(true);

                    this.$http.delete(url).then(response => {
                        self.setLoading(false);

                        setTimeout(() => {
                            self.getAllGrants();
                        }, 800);
                    });
                },

                getAllGrants () {
                    let self = this;
                    let url = '{{ route('api.grants.all') }}';

                    this.setLoading(true);

                    this.$http.get(url).then(response => {
                        console.log(response);

                        self.setGrants(response);
                        self.setLoading(false);
                    });
                },

                setGrants (grants) {
                    this.grants = grants;
                },

                setLoading (loading) {
                    if (! loading) {
                        setTimeout(() => {
                            this.loading = loading;
                        }, 800);
                    } else {
                        this.loading = loading;
                    }
                },

                getGrants () {
                    return this.grants;
                },

                getLoading () {
                    return this.loading;
                },

                setGrant (grant) {
                    this.grant = grant;
                },

                getGrant () {
                    return this.grant;
                },
            }
        });
    </script>
@endpush
