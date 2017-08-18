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
                    <v-menu bottom right>
                        <v-btn icon slot="activator">
                            <v-icon>more_vert</v-icon>
                        </v-btn>
                        <v-list>
                            <v-list-tile href="{{ route('roles.edit', $resource->id) }}">
                                <v-list-tile-title>
                                    <v-icon>edit</v-icon> {{ _('Edit') }}
                                </v-list-tile-title>
                            </v-list-tile>
                            <v-list-tile>
                                <v-dialog v-model="resource.dialog.model" lazy min-width="300px">
                                    <v-list-tile-title slot="activator">
                                        <v-icon>delete</v-icon> {{ __('Delete') }}
                                    </v-list-tile-title>
                                    <v-card class="text-xs-center">
                                        <v-card-text>
                                            <v-icon class="display-2">delete</v-icon>
                                            <br>
                                            {{ __('Move this resource to trash?') }}
                                        </v-card-text>
                                        <v-card-actions>
                                            <v-spacer></v-spacer>
                                            <form action="{{ route('roles.destroy', $resource->id) }}" method="POST" class="inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn--flat error error--text" type="submit"><span class="btn__content">Delete</span></button>
                                            </form>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
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
                    <a role="button" href="{{ route('roles.index') }}" class="btn btn--flat"><span class="btn__content"><v-icon>keyboard_backspace</v-icon>{{ _('Back') }}</span></a>
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
                };
            },
            mounted () {
                let self = this;

                {{-- {{ route('api.roles.permissions') }} --}}
                // this.postResource('')
                //     .then((data) => {
                //         let items = [];
                //         for (var key in data.items) {
                //             items.push({header: key});
                //             for (var i = 0; i < data.items[key].length; i++) {
                //                 items.push(data.items[key][i]);
                //             }
                //             items.push({divider: true});
                //         }
                //         self.permissions.items = items;
                //     });
            }
        })
    </script>
@endpush
