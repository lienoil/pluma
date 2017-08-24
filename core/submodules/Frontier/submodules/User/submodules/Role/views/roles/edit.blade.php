@extends("Theme::layouts.admin")

@section("head-title", __('Edit Role'))
@section("page-title", __('Edit Role'))

@push("page-settings")
    <v-card>
        <v-card-text>
            <h5 class="headline accent--text">
                {{ __($application->page->title) }}
            </h5>
        </v-card-text>
    </v-layout>
@endpush

@section("content")
    <v-container fluid>
        <v-layout row wrap>
            <v-flex sm8 offset-sm2>
                @include("Theme::partials.banner")
                <v-card class="grey--text elevation-1 mb-2">
                    <v-toolbar class="transparent elevation-0">
                        <v-toolbar-title class="accent--text">{{ __('Edit Role') }}</v-toolbar-title>
                        <v-spacer></v-spacer>
                        <v-btn flat href="{{ route('roles.index') }}"><v-icon>keyboard_backspace</v-icon>{{ _('Back') }}</v-btn>
                    </v-toolbar>
                    <form action="{{ route('roles.update', $resource->id) }}" method="POST">
                        <v-card-text>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <v-text-field
                                :error-messages="resource.errors.name"
                                label="Name"
                                name="name"
                                value="{{ $resource->name }}"
                                @input="(val) => { resource.item.name = val; }"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.code"
                                hint="{{ __('Will be used as an ID for Roles. Make sure the code is unique.') }}"
                                label="Code"
                                name="code"
                                :value="resource.item.name ? resource.item.name : '{{ $resource->code }}' | slugify"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.description"
                                label="Description"
                                name="description"
                                value="{{ $resource->description }}"
                            ></v-text-field>
                            <v-text-field
                                :error-messages="resource.errors.alias"
                                hint="{{ __('Will be used as an alias.') }}"
                                label="{{ _('Alias') }}"
                                value="{{ $resource->alias }}"
                                name="alias"
                            ></v-text-field>
                        </v-card-text>
                        <v-layout row wrap>
                            <v-flex xs12>
                                <v-toolbar class="transparent elevation-0">
                                    <v-toolbar-title class="subheading">{{ __('Selected Grants') }}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                </v-toolbar>
                                <v-card-text class="text-xs-center">
                                    <template v-if="suppliments.grants.selected.length">
                                        <template v-for="(grant, i) in suppliments.grants.selected">
                                            <v-chip
                                                width="100px"
                                                label
                                                close
                                                success
                                                @click.native.stop
                                                @input="suppliments.grants.selected.splice(i, 1)"
                                                class="chip--select-multi pink darken-3 white--text"
                                                :key="i"
                                            >
                                                <input type="hidden" name="grants[]" :value="JSON.stringify(grant)">
                                                @{{ grant.name }}
                                            </v-chip>
                                        </template>
                                    </template>
                                    <small v-else class="grey--text">{{ __('No chosen Grants') }}</small>
                                </v-card-text>
                            </v-flex>
                            <v-flex xs12>
                                <v-toolbar class="transparent elevation-0">
                                    <v-toolbar-title class="subheading">{{ __('Available Grants') }}</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-text-field
                                        append-icon="search"
                                        label="{{ _('Search') }}"
                                        single-line
                                        hide-details
                                        v-model="suppliments.grants.searchform.query"
                                        light
                                    ></v-text-field>
                                </v-toolbar>

                                <v-data-table
                                    class="elevation-0"
                                    no-data-text="{{ _('No resource found') }}"
                                    select-all
                                    selected-key="id"
                                    {{-- hide-actions --}}
                                    v-bind:search="suppliments.grants.searchform.query"
                                    v-bind:headers="suppliments.grants.headers"
                                    v-bind:items="suppliments.grants.items"
                                    v-model="suppliments.grants.selected"
                                    v-bind:pagination.sync="suppliments.grants.pagination"
                                >
                                    <template slot="items" scope="prop">
                                        <tr role="button" :active="prop.selected" @click="prop.selected = !prop.selected">
                                            <td>
                                                <v-checkbox
                                                    primary
                                                    hide-details
                                                    class="pa-0"
                                                    :input-value="prop.selected"
                                                ></v-checkbox>
                                            </td>
                                            <td>@{{ prop.item.name }}</td>
                                        </tr>
                                    </template>
                                </v-data-table>
                            </v-flex>
                        </v-layout>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn primary type="submit" class="elevation-1">{{ _('Update') }}</v-btn>
                        </v-card-actions>
                    </form>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            name: '',
                            code: '',
                            description: '',
                            grants: '',
                        },
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    suppliments: {
                        grants: {
                            headers: [
                                { text: '{{ __("Name") }}', align: 'left', value: 'name' },
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
                        }
                    },
                };
            },

            methods: {
                mountSuppliments () {
                    let items = {!! json_encode($grants) !!};
                    let g = [];
                    for (var i in items) {
                        g.push({
                            id: i,
                            name: items[i],
                        });
                    }
                    this.suppliments.grants.items = g;

                    let selected = {!! json_encode($resource->grants->pluck('name', 'id')) !!};
                    console.log("selected",selected);
                    let s = [];
                    if (selected) {
                        for (var i in selected) {
                            s.push({
                                id: i,
                                name: selected[i],
                            });
                        }
                    }
                    this.suppliments.grants.selected = s ? s : [];
                },
            },

            mounted () {
                this.mountSuppliments();
            }
        });
    </script>
@endpush
