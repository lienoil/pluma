@extends("Theme::layouts.admin")

@section("head-title", __($resource->name))
@section("page-title", __($resource->name))

@section("content")
    @include("Frontier::partials.banner")

    <v-layout row wrap>
        <v-flex sm8 xs12 offset-sm2>
            <v-card class="grey--text elevation-1 mb-2">
                <v-toolbar class="transparent elevation-0">
                    <v-toolbar-title class="accent--text">{{ __($resource->name) }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-menu bottom left>
                        <v-btn icon flat slot="activator"><v-icon>more_vert</v-icon></v-btn>
                        <v-list>
                            <v-list-tile :href="route(urls.roles.edit, ('{{ $resource->id }}'))">
                                <v-list-tile-action>
                                    <v-icon accent>edit</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        {{ __('Edit') }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            {{-- <v-list-tile @click.native.stop="post(route(urls.roles.api.clone, ('{{ $resource->id }}')))">
                                <v-list-tile-action>
                                    <v-icon accent>content_copy</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        {{ __('Clone') }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile> --}}
                            <v-list-tile
                                @click.native.stop="destroy(route(urls.roles.api.destroy, '{{ $resource->id }}'),
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
                            <v-subheader>{{ __('Grants') }}</v-subheader>
                        </v-flex>
                        <v-flex xs8>
                            <v-expansion-panel class="elevation-0" expand>
                                <v-expansion-panel-content v-for="(grant, i) in resource.item.grants" :key="i">
                                    <div slot="header">@{{ grant.name }}</div>
                                    <v-card>
                                        <v-card-text class="grey lighten-4">
                                            <ul>
                                                <li v-for="(permission, i) in grant.permissions">
                                                    <strong>@{{ permission.code }}</strong>
                                                    <br>
                                                    <span>@{{ permission.name }}</span>
                                                </li>
                                            </ul>
                                        </v-card-text>
                                    </v-card>
                                </v-expansion-panel-content>
                            </v-expansion-panel>
                        </v-flex>
                    </v-layout>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn flat href="{{ route('roles.index') }}"><v-icon>keyboard_backspace</v-icon>{{ _('Back') }}</v-btn>
                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: {!! json_encode($resource) !!},
                        model: false,
                        dialog: {
                            model: false,
                        },
                    },
                    urls: {
                        roles: {
                            api: {
                                clone: '{{ route('api.roles.clone', 'null') }}',
                                destroy: '{{ route('api.roles.destroy', 'null') }}',
                            },
                            show: '{{ route('roles.show', 'null') }}',
                            edit: '{{ route('roles.edit', 'null') }}',
                            destroy: '{{ route('roles.destroy', 'null') }}',
                        },
                    },
                };
            },
            mounted () {
                let self = this;
            }
        })
    </script>
@endpush
