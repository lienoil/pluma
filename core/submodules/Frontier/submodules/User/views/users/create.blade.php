@extends("Theme::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex sm8>
            <v-card class="mb-3">
                <v-toolbar card class="transparent">
                    <v-toolbar-title class="accent--text">{{ __($application->page->title) }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                    <form action="{{ route('roles.store') }}" method="POST">
                        {{ csrf_field() }}
                        <v-layout row wrap>
                            <v-flex md2>
                                <v-text-field
                                    :error-messages="resource.errors.prefixname"
                                    label="{{ _('Prefix Name') }}"
                                    name="prefixname"
                                    value="{{ old('prefixname') }}"
                                    input-group
                                ></v-text-field>
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
                                    :error-messages="resource.errors.username"
                                    label="{{ _('User Name') }}"
                                    name="username"
                                    value="{{ old('username') }}"
                                    input-group
                                ></v-text-field>
                            </v-flex>
                            <v-flex sm6>
                                <v-text-field
                                    :error-messages="resource.errors.email"
                                    label="{{ _('Email') }}"
                                    name="email"
                                    value="{{ old('email') }}"
                                    input-group
                                ></v-text-field>
                            </v-flex>
                        </v-layout>
                        <v-layout row wrap>
                            <v-flex md12>
                                <v-select
                                    :error-messages="resource.errors.roles"
                                    auto
                                    autocomplete
                                    chips
                                    item-text="text"
                                    item-value="value"
                                    label="{{ __('Roles') }}"
                                    hide-details
                                    multiple
                                    v-bind:items="suppliments.roles.items"
                                    v-model="suppliments.roles.selected"
                                >
                                    <template slot="selection" scope="data">
                                        <v-chip
                                            close
                                            @input="data.parent.selectItem(data.item)"
                                            @click.native.stop
                                            class="chip--select-multi"
                                            :key="data.item"
                                        >
                                            <input type="hidden" name="roles[]" :value="data.item.value">
                                            @{{ data.item.text }}
                                        </v-chip>
                                    </template>
                                </v-select>
                            </v-flex>
                        </v-layout>
                    </form>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendor/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

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
        });
    </script>
@endpush


