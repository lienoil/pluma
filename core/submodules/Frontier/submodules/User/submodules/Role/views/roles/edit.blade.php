@extends("Theme::layouts.admin")

@section("head-title", __('Edit Role'))
@section("page-title", __('Edit Role'))

@push("page-settings")
    <v-card>
        <v-card-text>
            <h5 class="headline">
                {{ __($application->page->title) }}
            </h5>
            {{--  --}}
        </v-card-text>
    </v-layout>
@endpush

@section("content")
    @include("Theme::partials.banner")

    <v-layout row wrap>
        <v-flex sm8>
            <v-card class="grey--text elevation-1 mb-2">
                <v-toolbar class="transparent elevation-0">
                    <v-toolbar-title class="accent--text">{{ __('Edit Role') }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                    <form action="{{ route('roles.update', $resource->id) }}" method="POST">
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
                        <v-select
                            :error-messages="resource.errors.grants"
                            auto
                            autocomplete
                            chips
                            item-text="text"
                            item-value="value"
                            label="{{ __('Grants') }}"
                            multiple
                            v-bind:items="suppliments.grants.items"
                            v-model="suppliments.grants.selected"
                        >
                            <template slot="selection" scope="data">
                                <v-chip
                                    close
                                    @input="data.parent.selectItem(data.item)"
                                    @click.native.stop
                                    class="chip--select-multi"
                                    :key="data.item"
                                >
                                    <input type="hidden" name="grants[]" :value="data.item.value">
                                    @{{ data.item.text }}
                                </v-chip>
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
                            items: [],
                            selected: [],
                        }
                    },
                };
            },

            methods: {
                mountSuppliments () {
                    let items = {!! json_encode($grants) !!};
                    let g = [];
                    for (var i in items) {
                        g.push({ text: items[i], value: i});
                    }
                    this.suppliments.grants.items = g;

                    let selected = {!! json_encode($resource->grants->pluck('id')) !!};
                    let s = [];
                    for (var i = 0; i < selected.length; i++) {
                        s.push(selected[i].toString());
                    }
                    this.suppliments.grants.selected = s ? s : [];

                },
            },

            mounted () {
                this.mountSuppliments();
            }
        })
    </script>
@endpush
