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
                                    color="primary"
                                    v-model="suppliments.users.selected"
                                ></v-select>
                                <input type="hidden" name="users[]" :value="id" v-for="(id, i) in suppliments.users.selected" :key="i">

                                <v-card-actions>
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
                                <v-dialog transition="scale-transition" v-model="dataset.dialog.model" lazy width="auto">
                                    <v-btn flat icon slot="activator" v-tooltip:left="{'html': `Permanently delete ${dataset.selected.length} selected items`}">
                                        <v-icon class="error--text">delete_forever</v-icon>
                                    </v-btn>
                                    <v-card class="elevation-4 text-xs-center">
                                        <v-card-text class="pa-5">
                                            <p class="headline ma-2"><v-icon round class="warning--text display-4">info_outline</v-icon></p>
                                            <h2 class="display-1 grey--text text--darken-2"><strong>{{ __('Are you sure?') }}</strong></h2>
                                            <div class="grey--text text--darken-1">
                                                <div class="mb-1">{{ __("You are about to permanently delete those students.") }}</div>
                                                <div>{{ __("This action is irreversible. Do you want to proceed?") }}</div>
                                            </div>
                                        </v-card-text>
                                        <v-divider></v-divider>
                                        <v-card-actions class="pa-3">
                                            <v-btn class="grey--text grey lighten-2 elevation-0" flat @click.native.stop="dataset.dialog.model=false">{{ __('Cancel') }}</v-btn>
                                            <v-spacer></v-spacer>
                                            <template v-if="dataset.selected.length > 1">
                                                <form action="{{ route('students.drop', $resource->id) }}" method="POST" class="inline">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <template v-for="item in dataset.selected">
                                                        <input type="hidden" name="user_id[]" :value="item.id">
                                                    </template>
                                                    <v-btn
                                                        class="elevation-0 ma-0 error white--text"
                                                        type="submit"
                                                    >{{ __('Yes') }}</v-btn>
                                                </form>
                                            </template>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
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
                            <td v-show="bulk.drop.model">
                                <v-checkbox
                                    hide-details
                                    class="primary--text lighten-2"
                                    v-model="prop.selected">
                                </v-checkbox>
                            </td>
                            <td v-html="prop.item.id"></td>
                            <td v-html="prop.item.displayname"></td>
                            <td v-html="prop.item.enrolled"></td>
                            <td class="text-xs-center">

                                <v-dialog v-model="prop.item.dialogmodel" transition="scale-transition" persistent width="400px" min-width="150px" max-width="400px">
                                    <v-btn slot="activator" v-tooltip:left="{ html: 'Drop a student' }" icon>
                                        <v-icon>delete</v-icon>
                                    </v-btn>
                                    <v-card class="text-xs-center elevation-4">
                                        <v-card-text class="pa-5">
                                            <p class="headline ma-2"><v-icon round class="warning--text display-4">info_outline</v-icon></p>
                                            <h2 class="display-1 grey--text text--darken-2"><strong>{{ __('Are you sure?') }}</strong></h2>
                                            <div class="grey--text text--darken-1">
                                                <span class="mb-3">{{ __("You are about to drop") }} <strong><em>@{{ prop.item.displayname }} </em></strong> {{ __('from this course.') }}</span>
                                                <span>{{ __("This action is irreversible. Do you want to proceed?") }}</span>
                                            </div>
                                        </v-card-text>
                                        <v-divider></v-divider>
                                        <v-card-actions class="pa-3">
                                            <v-btn class="grey--text grey lighten-2 elevation-0"
                                                @click.native.stop="() => { prop.item.dialogmodel=false }">
                                                {{ __('Cancel') }}
                                            </v-btn>
                                            <v-spacer></v-spacer>
                                            <form
                                                :id="`drop_${prop.item.id}`"
                                                :ref="`drop_${prop.item.id}`"
                                                action="{{ route('students.drop', $resource->id) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <input type="hidden" name="user_id[]" :value="prop.item.id">
                                                <v-btn @click="$refs[`drop_${prop.item.id}`].submit()"
                                                    class="elevation-0 ma-0 error white--text">{{ __('Yes') }}
                                                </v-btn>
                                            </form>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
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
                        dialog: {
                            model: false,
                        },
                    },
                    urls: {
                        students: {
                            drop: '{{ route('students.drop', 'null') }}'
                        }
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
                setDialog (model, data) {
                    this.resource.dialog.model = model;
                    this.resource.dialog.data = data;
                },
            },

            mounted () {
                this.mountSuppliments();
            }
        });
    </script>

@endpush
