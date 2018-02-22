@extends("Frontier::layouts.admin")

@section("head-title", __($resource->name))

@section("content")
<<<<<<< HEAD
    <v-container fluid grid-list-lg>
        @include("Frontier::partials.banner")
        <v-layout row wrap>
            <v-flex sm8 xs12 offset-sm2>
                <v-card class="grey--text elevation-1 mb-2">
                    <v-toolbar class="primary elevation-0">
                        <v-toolbar-title class="white--text">{{ __($resource->name) }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <v-subheader>{{ __('Name') }}</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <v-text-field
                                    name="name"
                                    label="{{ __('Name') }}"
                                    value="{{ $resource->name }}"
                                    disabled
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <v-subheader>{{ __('Code') }}</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <v-text-field
                                    name="code"
                                    label="{{ __('Code') }}"
                                    value="{{ $resource->code }}"
                                    disabled
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <v-subheader>{{ __('Description') }}</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <v-text-field
                                    name="description"
                                    label="{{ __('Description') }}"
                                    value="{{ $resource->description }}"
                                    disabled
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <v-subheader>{{ __('Permissions') }}</v-subheader>
                            </v-flex>
                            <v-flex xs8>
                                <template v-for="(permission, i) in permission.item.permissions">
=======
    @include("Frontier::partials.banner")
    <v-toolbar dark extended class="secondary elevation-0">
        <v-btn
            href="{{ route('grants.index') }}"
            ripple
            flat
            >
            <v-icon left dark>arrow_back</v-icon>
            Back
        </v-btn>
    </v-toolbar>

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex sm8 xs12 offset-sm2>
                <v-card class="card--flex-toolbar grey--text elevation-1 mb-2">
                    <v-toolbar class="elevation-0 transparent">
                        <v-toolbar-title class="accent--text">{{ __($resource->name) }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-menu bottom left>
                            <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                            <v-list>
                                <v-list-tile ripple
                                :href="route(urls.grants.edit, ('{{ $resource->id }}'))">
                                    <v-list-tile-action>
                                        <v-icon accent>edit</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            {{ __('Edit') }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                                <v-list-tile ripple
                                    @click="destroy(route(urls.grants.api.destroy, '{{ $resource->id }}'),
                                    {
                                        '_token': '{{ csrf_token() }}'
                                    })">
                                    <v-list-tile-action>
                                        <v-icon warning>delete</v-icon>
                                    </v-list-tile-action>
                                    <v-list-tile-content>
                                        <v-list-tile-title>
                                            {{ __('Move to Trash') }}
                                        </v-list-tile-title>
                                    </v-list-tile-content>
                                </v-list-tile>
                            </v-list>
                        </v-menu>
                    </v-toolbar>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <div class="grey--text">{{ __('Name') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                <div class="grey--text text--darken-3">{{ $resource->name }}</div>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <div class="grey--text">{{ __('Code') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                <div class="grey--text text--darken-3">{{ $resource->code }}</div>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <div class="grey--text">{{ __('Description') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                <div class="grey--text text--darken-3">{{ $resource->description }}</div>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex xs4>
                                <div class="grey--text">{{ __('Permissions') }}</div>
                            </v-flex>
                            <v-flex xs8>
                                {{-- <template v-for="(permission, i) in permission.item.permissions">
>>>>>>> dev
                                    <p>
                                        <strong>@{{ permission.name }}</strong>
                                        <br>
                                        <span>@{{ permission.code }}</span>
                                    </p>
<<<<<<< HEAD
                                </template>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                    <v-card-actions class="text-xs-center">
                        <v-spacer></v-spacer>
                        <a role="button" href="{{ route('grants.edit', $resource->id) }}" class="btn btn--raised primary"><span class="btn__content"><v-icon class="white--text">edit</v-icon> {{ _('Edit') }}</span></a>
                        <form action="{{ route('grants.destroy', $resource->id) }}" method="POST" class="inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" v-tooltip:bottom="{'html': 'Move to Trash'}" class="btn btn--raised error"><span class="btn__content"><v-icon class="white--text">delete</v-icon> Delete</span></button>
                        </form>
                        <v-spacer></v-spacer>
                    </v-card-actions>
=======
                                </template> --}}
                                <v-list two-line subheader>
                                    <v-list-tile avatar v-for="(permission, i) in permission.item.permissions">
                                        <v-list-tile-avatar>
                                            <v-icon class="green--text text--lighten-2">verified_user</v-icon>
                                        </v-list-tile-avatar>
                                        <v-list-tile-content>
                                            <v-list-tile-title>@{{ permission.name }}</v-list-tile-title>
                                            <v-list-tile-sub-title>@{{ permission.code }}</v-list-tile-sub-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
>>>>>>> dev
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

<<<<<<< HEAD
=======
@push('css')
    <style>
        .card--flex-toolbar {
            margin-top: -80px;
        }
    </style>
@endpush

>>>>>>> dev
@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    permission: {
                        item: {!! json_encode($resource) !!},
                    },
<<<<<<< HEAD
                };
            },
            mounted () {
                let self = this;

                this.postResource('{{ route('api.grants.permissions') }}')
                    .then((data) => {
                        let items = [];
                        for (var key in data.items) {
                            items.push({header: key});
                            for (var i = 0; i < data.items[key].length; i++) {
                                items.push(data.items[key][i]);
                            }
                            items.push({divider: true});
                        }
                        self.permissions.items = items;
                    });
=======
                    urls: {
                        grants: {
                            api: {
                                clone: '{{ route('api.grants.clone', 'null') }}',
                                destroy: '{{ route('api.grants.destroy', 'null') }}',
                            },
                            show: '{{ route('grants.show', 'null') }}',
                            edit: '{{ route('grants.edit', 'null') }}',
                            destroy: '{{ route('grants.destroy', 'null') }}',
                        },
                    },
                };
            },
            methods: {
                 destroy (url, query) {
                    var self = this;
                    this.api().delete(url, query)
                        .then((data) => {
                            self.get('{{ route('api.grants.all') }}');
                            self.snackbar = Object.assign(self.snackbar, data.response.body);
                            self.snackbar.model = true;
                        });
                },
            },
            mounted () {
                let self = this;
>>>>>>> dev
            }
        })
    </script>
@endpush
