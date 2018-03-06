@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex md3 xs12>
                <form action="{{ route('students.store', $resource->id) }}" method="POST">
                    {{ csrf_field() }}
                    <v-card class="elevation-1 mb-3">
                        <v-toolbar flat class="transparent">
                            <v-toolbar-title class="subheading">{{ __('Enroll Students') }}</v-toolbar-title>
                        </v-toolbar>

                        <template v-if="resource.users.length">
                            <v-card-actions class="pa-0">
                                <v-subheader class="caption grey--text"><em>{{ __('You may enroll multiple students to this course') }}</em></v-subheader>
                            </v-card-actions>

                            <v-card-text>
                                <v-select
                                    :error-messages="resource.errors.users"
                                    :items="suppliments.users.items"
                                    autocomplete
                                    item-text="name"
                                    item-value="id"
                                    label="{{ __('Users') }}"
                                    multiple
                                    persistent-hint
                                    prepend-icon="supervisor_account"
                                    v-model="suppliments.users.selected"
                                ></v-select>
                                <input type="hidden" name="users[]" :value="id" v-for="(id, i) in suppliments.users.selected" :key="i">

                                <v-card-actions class="pa-3">
                                    <v-spacer></v-spacer>
                                    <v-btn primary class="elevation-1" type="submit">{{ __('Enroll') }}</v-btn>
                                </v-card-actions>
                            </v-card-text>
                        </template>
                        <template v-else>
                            <v-card-text>
                                <p class="text-xs-center body-1 grey--text">
                                    <em>{{ __('No available users to enroll') }}</em>
                                </p>
                            </v-card-text>
                        </template>
                    </v-card>
                </form>
            </v-flex>

            <v-flex md9 xs12>
                <v-card class="mb-3 elevation-1">

                    <v-toolbar flat class="transparent">
                        <v-icon left>supervisor_account</v-icon>
                        <v-toolbar-title primary-title class="subheading">{{ __('Students Enrolled') }}</v-toolbar-title>
                        <v-spacer></v-spacer>

                        {{-- Batch Commands --}}
                        <v-btn
                            v-show="dataset.selected.length < 2"
                            flat
                            icon
                            v-model="bulk.drop.model"
                            :class="bulk.drop.model ? 'btn--active primary primary--text' : ''"
                            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checkboxes') }}'}"
                            @click.native="bulk.drop.model = !bulk.drop.model"
                        ><v-icon>@{{ bulk.drop.model ? 'check_circle' : 'check_circle' }}</v-icon></v-btn>

                        {{-- Bulk Delete --}}
                        <v-slide-y-transition>
                            <template v-if="dataset.selected.length > 1">
                                <form action="{{ route('students.drop', $resource->id) }}" method="POST" class="inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <template v-for="item in dataset.selected">
                                        <input type="hidden" name="user_id[]" :value="item.id">
                                    </template>
                                    <v-btn
                                        flat
                                        icon
                                        type="submit"
                                        v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}"
                                    ><v-icon warning>delete_sweep</v-icon></v-btn>
                                </form>
                            </template>
                        </v-slide-y-transition>
                        {{-- /Bulk Delete --}}
                        {{-- /Batch Commands --}}

                    </v-toolbar>

                    <v-data-table
                        :loading="dataset.loading"
                        :total-items="dataset.totalItems"
                        class="elevation-0"
                        no-data-text="{{ _('No resource found') }}"
                        v-bind="bulk.drop.model?{'select-all':'primary'}:[]"
                        v-bind:headers="dataset.headers"
                        v-bind:items="dataset.items"
                        v-bind:pagination.sync="dataset.pagination"
                        v-model="dataset.selected">
                        <template slot="headerCell" scope="props">
                            <span v-tooltip:bottom="{'html': props.header.text}">
                                @{{ props.header.text }}
                            </span>
                        </template>
                        <template slot="items" scope="prop">
                            <td v-show="bulk.drop.model"><v-checkbox hide-details class="primary--text" v-model="prop.selected"></v-checkbox></td>
                            <td v-html="prop.item.id"></td>
                            <td v-html="prop.item.displayname"></td>
                            <td v-html="prop.item.enrolled"></td>
                            <td class="text-xs-center">
                                <v-menu bottom left>
                                    <v-btn icon flat slot="activator" v-tooltip:left="{html: 'More Actions'}"><v-icon>more_vert</v-icon></v-btn>
                                    <v-list>
                                        <v-list-tile ripple @click="">
                                            <v-list-tile-action>
                                                <v-icon warning>delete</v-icon>
                                            </v-list-tile-action>
                                            <v-list-tile-content>
                                                <v-list-tile-title>
                                                    {{__('Move to Trash')}}
                                                </v-list-tile-title>
                                            </v-list-tile-content>
                                        </v-list-tile>
                                    </v-list>
                                </v-menu>
                            </td>
                        </template>
                    </v-data-table>
                </v-card>
                @if (\Illuminate\Support\Facades\Request::all())
                    <v-btn error flat href="{{ route('students.index') }}" class="">
                        <v-icon left>remove_circle_outline</v-icon>
                        {{ __('Remove filter') }}
                    </v-btn>
                @endif
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .search-bar label{
            padding-top: 8px;
            padding-bottom: 8px;
            padding-left: 25px !important;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        drop: {
                            model: false,
                        },
                    },
                    resource: {
                        item: {
                            user_id: '{{ @(old('user_id') ?? $resource->user->id) }}',
                        },
                        users: {!! json_encode($users->toArray()) !!},
                        errors: JSON.parse('{!! json_encode($errors->getMessages()) !!}'),
                    },
                    urls: {
                        drop: '{{ route('students.drop', 'null') }}',
                    },
                    suppliments: {
                        users: {
                            headers: [
                                { text: '{{ __("Name") }}', align: 'left', value: 'name' },
                                { text: '{{ __("Code") }}', align: 'left', value: 'code' },
                                { text: '{{ __("Description") }}', align: 'left', value: 'description' },
                            ],
                            pagination: {
                                rowsPerPage: '{{ settings('items_per_page', 15) }}',
                                totalItems: 0,
                            },
                            items: [],
                            selected: [],
                            searchform: {
                                query: '',
                                model: true,
                            }
                        },
                        required_fields: {
                            model: false,
                        },
                    },
                    bulk: {
                        drop: {
                            model: false,
                        },
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Full Name") }}', align: 'left', value: 'displayname' },
                            { text: '{{ __("Enrolled") }}', align: 'left', value: 'enrolled_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
                        dialog: {
                            model: false,
                        },
                        loading: true,
                        pagination: {
                            rowsPerPage: '{{ settings('items_per_page', 15) }}',
                            totalItems: 0,
                        },
                        searchform: {
                            model: false,
                            query: '',
                        },
                        selected: [],
                        totalItems: 0,
                    },
                };
            },

            watch: {
                'dataset.pagination': {
                    handler () {
                        this.get();
                    },
                    deep: true
                },

                'dataset.searchform.query': function (filter) {
                    setTimeout(() => {
                        const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;

                        let query = {
                            descending: descending,
                            page: page,
                            search: filter,
                            sort: sortBy,
                            take: rowsPerPage,
                        };

                        this.api().search('{{ route('api.students.all') }}', query)
                            .then((data) => {
                                this.dataset.items = data.items.data ? data.items.data : data.items;
                                this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                                this.dataset.loading = false;
                            });
                    }, 1000);
                },
            },

            methods: {
                mountSuppliments () {
                    let items = {!! json_encode($users->toArray()) !!};
                    let g = [];
                    for (var i in items) {
                        g.push({
                            id: items[i].id,
                            name: items[i].fullname,
                        });
                    }
                    this.suppliments.users.items = g;

                    let selected = {!! json_encode(old('users')) !!};
                    let s = [];
                    if (selected) {
                        for (var i in selected) {
                            for (var j = items.length - 1; j >= 0; j--) {
                                if (selected[i] == items[j].id) {
                                    let instance = items[j];
                                    s.push({
                                        id: instance.id,
                                        name: instance.name,
                                    });
                                }
                            }
                        }
                    }
                    this.suppliments.users.selected = s ? s : [];
                    // console.log(this.suppliments.users.items);
                },

                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy,
                        take: rowsPerPage,
                        course_id: {{ $resource->id }},
                        search: {!! @json_encode(\Illuminate\Support\Facades\Request::all()) !!},
                    };
                    this.api().get('{{ route('api.students.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                this.mountSuppliments();
            }
        });
    </script>

@endpush
