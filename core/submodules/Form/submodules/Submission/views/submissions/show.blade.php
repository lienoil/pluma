@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    {{-- graph --}}
    @include("Submission::widgets.results")
    {{-- /graph --}}

    <v-toolbar dark class="light-blue elevation-1">
        <v-toolbar-title>{{ __('Submissions') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        {{-- Batch Commands --}}

        {{-- Search --}}
        <template>
            <v-text-field
                :append-icon-cb="() => {dataset.searchform.model = !dataset.searchform.model}"
                :prefix="dataset.searchform.prefix"
                :prepend-icon="dataset.searchform.prepend"
                append-icon="close"
                light solo hide-details single-line
                label="Search"
                v-model="dataset.searchform.query"
                v-show="dataset.searchform.model"
            ></v-text-field>
            {{--  <v-select
                label="Search"
                chips
                tags
                solo
                prepend-icon="search"
                append-icon=""
                clearable
                autofocus
                >
            </v-select> --}}
            <v-btn v-show="!dataset.searchform.model" icon v-tooltip:left="{'html': dataset.searchform.model ? 'Clear' : 'Search resources'}" @click.native="dataset.searchform.model = !dataset.searchform.model;dataset,searchform.query = '';"><v-icon>search</v-icon></v-btn>
        </template>
        {{-- /Search --}}

        {{-- add --}}
        <v-btn icon v-tooltip:left="{ html: 'Create' }" href="{{ route('submissions.create') }}"><v-icon>add</v-icon></v-btn>
        {{-- /add --}}

        <v-btn
            v-show="dataset.selected.length < 2"
            flat
            icon
            v-model="bulk.destroy.model"
            :class="bulk.destroy.model ? 'btn--active primary primary--text' : ''"
            v-tooltip:left="{'html': '{{ __('Toggle the bulk command checkboxes') }}'}"
            @click.native="bulk.destroy.model = !bulk.destroy.model">
            <v-icon>@{{ bulk.destroy.model ? 'check_circle' : 'check_circle' }}</v-icon>
        </v-btn>

        {{-- Bulk Delete --}}
        <v-slide-y-transition>
            <template v-if="dataset.selected.length > 1">
                <form :action="route(urls.submissions.destroy, false)" method="POST" class="inline">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <template v-for="item in dataset.selected">
                        <input type="hidden" name="id[]" :value="item.id">
                    </template>
                    <v-btn flat icon type="submit" v-tooltip:left="{'html': `Move ${dataset.selected.length} selected items to Trash`}"><v-icon warning>delete_sweep</v-icon></v-btn>
                </form>
            </template>
        </v-slide-y-transition>
        {{-- /Bulk Delete --}}
        {{-- /Batch Commands --}}

        {{-- Trashed --}}
       {{--  <v-btn
            icon
            flat
            href="{{ route('submissions.trashed') }}"
            dark
            v-tooltip:left="{'html': `View trashed items`}"
        ><v-icon class="warning--after" v-badge:{{ $trashed }}.overlap>archive</v-icon></v-btn> --}}
        {{-- /Trashed --}}

    </v-toolbar>
    <v-container fluid grid-list-lg>
        <v-layout row wrap>
            <v-flex xs12>
                <v-card flat class="transparent">
                    <v-layout row wrap>
                        <v-flex md8 offset-md2 xs12>
                            <v-card class="card--flex-toolbar">
                                <v-toolbar card prominent class="transparent">
                                    <v-toolbar-title class="title">{{ __($resource->form->name) }}</v-toolbar-title>
                                    <v-spacer></v-spacer>


                                    {{-- EXPORT --}}
                                    <form action="{{ route('submissions.export', $resource->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <v-btn primary type="submit" class="elevation-1 white--text">
                                            <v-icon left>fa-file-pdf-o</v-icon>
                                            {{ __('Export') }}
                                        </v-btn>
                                    </form>
                                    {{-- EXPORT --}}



                                </v-toolbar>
                                <v-divider></v-divider>
                                <v-card-text class="body-1">
                                    <v-card-actions class="pa-0">
                                        <div>
                                            <v-avatar size="25px">
                                                <img src="{{ $resource->user->avatar }}">
                                            </v-avatar>
                                            <span class="pl-2">{{ $resource->user->displayname }}</span>
                                        </div>
                                        <v-spacer></v-spacer>
                                        <v-icon>schedule</v-icon>
                                        <span>{{ $resource->created }}</span>
                                    </v-card-actions>
                                </v-card-text>

                                {{-- questions --}}
                                <v-card-text class="pa-4">
                                    @foreach ($resource->fields() as $field)
                                        <div class="fw-500"><v-icon class="mr-2 pb-1" style="font-size: 10px;">lens</v-icon> {{ $field->question->label }}</div>
                                        <div class="pa-3 grey--text text--darken-1" style="padding-left: 21px !important;">{{ $field->answer }}</div>
                                    @endforeach
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-card>
                @if (\Illuminate\Support\Facades\Request::all())
                <v-btn flat warning href="{{ route('submissions.index') }}" class=""><v-icon left>remove_circle</v-icon> {{ __('Remove filters') }}</v-btn>
                @endif
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    bulk: {
                        destroy: {
                            model: false,
                        },
                    },
                    urls: {
                        submissions: {
                            edit: '{{ route('submissions.edit', 'null') }}',
                            show: '{{ route('submissions.show', 'null') }}',
                            destroy: '{{ route('submissions.destroy', 'null') }}',
                        }
                    },
                    dataset: {
                        headers: [
                            { text: '{{ __("ID") }}', align: 'left', value: 'id' },
                            { text: '{{ __("Form Name") }}', align: 'left', value: 'form_id' },
                            { text: '{{ __("Submitted by") }}', align: 'left', value: 'user_id' },
                            { text: '{{ __("Created") }}', align: 'left', value: 'created_at' },
                            { text: '{{ __("Modified") }}', align: 'left', value: 'modified_at' },
                            { text: '{{ __("Actions") }}', align: 'center', sortable: false },
                        ],
                        items: [],
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

                        this.api().search('{{ route('api.submissions.all') }}', query)
                            .then((data) => {
                                this.dataset.items = data.items.data ? data.items.data : data.items;
                                this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                                this.dataset.loading = false;
                            });
                    }, 1000);
                },
            },

            methods: {
                get () {
                    const { sortBy, descending, page, rowsPerPage } = this.dataset.pagination;
                    let query = {
                        descending: descending,
                        page: page,
                        sort: sortBy,
                        take: rowsPerPage,
                        search: {!! @json_encode(\Illuminate\Support\Facades\Request::all()) !!},
                    };
                    this.api().get('{{ route('api.submissions.all') }}', query)
                        .then((data) => {
                            this.dataset.items = data.items.data ? data.items.data : data.items;
                            this.dataset.totalItems = data.items.total ? data.items.total : data.total;
                            this.dataset.loading = false;
                        });
                },
            },

            mounted () {
                // this.get();
            }
        });
    </script>

@endpush
