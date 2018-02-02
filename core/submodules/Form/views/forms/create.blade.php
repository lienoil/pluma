@extends("Frontier::layouts.admin")

@section("content")
    <v-container fluid grid-list-lg>
        @include("Theme::partials.banner")

        <form action="{{ route('forms.store') }}" method="POST">
            <input type="hidden" name="type" value="forms">
            {{ csrf_field() }}
            <v-layout row wrap>
                <v-flex md9>
                    <v-card class="mb-3 elevation-1">
                        <v-toolbar card class="transparent">
                            <v-toolbar-title class="accent--text">{{ __('New Form') }}</v-toolbar-title>
                            <v-spacer></v-spacer>
                        </v-toolbar>

                        <v-card-text>
                            <v-text-field
                                name="name"
                                :error-messages="resource.errors.name"
                                label="{{ __('Title') }}"
                                v-model="resource.item.name"
                                @input="() => { resource.item.code = $options.filters.slugify(resource.item.name); }"
                            ></v-text-field>

                            <v-text-field
                                :append-icon-cb="() => (resource.readonly.slug = !resource.readonly.slug)"
                                :append-icon="resource.readonly.slug ? 'fa-lock' : 'fa-unlock'"
                                :readonly="resource.readonly.slug"
                                :value="resource.item.code | slugify"
                                label="{{ __('Code') }}"
                                name="code"
                                persistent-hint
                                :error-messages="resource.errors.code"
                                hint="{{ __("Code is used in generating URL. To customize the code, toggle the lock icon on this field.") }}"
                            ></v-text-field>

                            <v-text-field
                                :error-messages="resource.errors.action"
                                label="{{ _('Action') }}"
                                name="action"
                                value="{{ old('action') }}"
                            ></v-text-field>

                            <v-menu full-width bottom>
                                <v-text-field
                                    append-icon="keyboard_arrow_down"
                                    :error-messages="resource.errors.method"
                                    hint="{{ __('Choose method') }}"
                                    label="{{ __('Method') }}"
                                    name="method"
                                    persistent-hint
                                    slot="activator"
                                    v-model="resource.item.method"
                                ></v-text-field>
                                <v-card>
                                    <v-list>
                                        <v-list-tile ripple @click="resource.item.method = method" :key="i" v-for="(method, i) in misc.methods">
                                            <v-list-tile-content>
                                                <span v-html="method"></span>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-card>
                            </v-menu>

                            <v-text-field
                                :error-messages="resource.errors.attributes"
                                label="{{ _('Attributes') }}"
                                name="attributes"
                                value="{{ old('attributes') }}"
                                multi-line
                            ></v-text-field>
                        </v-card-text>

                        <v-divider></v-divider>

                        {{-- Editor --}}
                        @include("Form::interactive.editor")
                        {{-- /Editor --}}

                        {{-- Add fields --}}
                        @include("Form::cards.fields")
                        {{-- /Add fields --}}
                    </v-card>
                </v-flex>

                <v-flex md3>
                    @include("Theme::cards.saving")

                    {{-- form-template --}}
                    @include("Theme::cards.form-attributes")
                    {{-- /form-template --}}
                </v-flex>
            </v-layout>
        </form>
    </v-container>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.css') }}">
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vuetify-quill/dist/vuetify-quill.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    resource: {
                        item: {
                            name: '{{ old('name') }}',
                            code: '{{ old('code') }}',
                            delta: '{!! old('delta') !!}',
                            body: '{!! old('body') !!}',
                            method: '{!! old('method') !!}',
                            template: '{!! old('template') !!}',
                        },
                        template: '{{ old('template') }}',
                        errors: {!! json_encode($errors->getMessages()) !!},
                        readonly: {
                            slug: true,
                        },
                        toggle: {
                            parent_id: false,
                        },
                        new: true,
                        misc: {
                            parent: {
                                title: 'None',
                            }
                        }
                    },
                    misc: {
                        methods: [
                            'PUT',
                            'POST',
                        ],
                    },
                    errors: {!! json_encode($errors->getMessages()) !!}
                }
            },
        })
    </script>
@endpush
