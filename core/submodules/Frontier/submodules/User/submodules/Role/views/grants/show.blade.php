@extends("Frontier::layouts.admin")

@section("head-title", __($resource->name))
@section("page-title", __($resource->name))

@section("content")
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
                                <p>
                                    <strong>@{{ permission.name }}</strong>
                                    <br>
                                    <span>@{{ permission.code }}</span>
                                </p>
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
                    permission: {
                        item: {!! json_encode($resource) !!},
                    },
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
            }
        })
    </script>
@endpush
