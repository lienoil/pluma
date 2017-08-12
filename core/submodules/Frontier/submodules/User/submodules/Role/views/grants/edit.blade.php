@extends("Frontier::layouts.admin")

@section("head-title", __('Edit Grant'))
@section("page-title", __('Edit Grant'))

@push("page-settings")
    <v-card>
        <v-card-text>
            <h5 class="headline">
                {{ __($application->page->title) }}
            </h5>
            <p class="grey--text">{{ __("Editing Grants will update the Roles' Permission associated as well.") }}</p>
        </v-card-text>
    </v-layout>
@endpush

@section("content")
    @include("Frontier::partials.banner")

    <v-layout row wrap>
        <v-flex sm8>
            <v-card class="grey--text elevation-1 mb-2">
                <v-toolbar class="primary elevation-0">
                    <v-toolbar-title class="white--text">{{ __('Edit Grant') }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                    <form action="{{ route('grants.update', $resource->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <v-text-field
                            name="name"
                            label="Name"
                            value="{{ $resource->name }}"
                        ></v-text-field>
                        <v-text-field
                            name="code"
                            label="Code"
                            value="{{ $resource->code }}"
                        ></v-text-field>
                        <v-text-field
                            name="description"
                            label="Description"
                            value="{{ $resource->description }}"
                        ></v-text-field>
                        <v-select
                            autocomplete
                            chips
                            item-text="name"
                            item-value="id"
                            name="permissions[]"
                            label="{{ __('Permissions') }}"
                            max-height="90vh"
                            multiple
                            v-bind:items="permissions.items"
                            v-model="permissions.selected"
                            :error-messages="errors.permissions"
                        >
                            <template slot="selection" scope="data">
                                <v-chip
                                    close
                                    @input="data.parent.selectItem(data.item)"
                                    @click.native.stop
                                    class="chip--select-multi"
                                    :key="data.item"
                                >
                                    <input type="hidden" name="permissions[]" :value="data.item.id">
                                    @{{ data.item.name }}
                                </v-chip>
                            </template>
                            <template slot="item" scope="data">
                                <template v-if="typeof data.item !== 'object'">
                                    <v-list-tile-content v-text="data.item"></v-list-tile-content>
                                </template>
                                <template v-else>
                                    <v-list-tile-content>
                                        <v-list-tile-title v-html="data.item.name"></v-list-tile-title>
                                        <v-list-tile-sub-title v-html="data.item.code"></v-list-tile-sub-title>
                                    </v-list-tile-content>
                                </template>
                            </template>
                        </v-select>
                        <div class="text-sm-right">
                            <button type="submit" class="btn btn--raised primary ma-0"><span class="btn__content">{{ __('Update') }}</span></button>
                        </div>
                    </form>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendor/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    availables: {!! json_encode($permissions) !!},
                    permissions: {
                        search: '',
                        selected: JSON.parse('{!! json_encode($resource->permissions) !!}'),
                        items: [],
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
