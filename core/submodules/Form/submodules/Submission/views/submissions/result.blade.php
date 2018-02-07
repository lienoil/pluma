@extends("Frontier::layouts.admin")

@section("content")
    @include("Theme::partials.banner")

    <v-toolbar dark extended class="indigo elevation-0">
        <v-btn
            href=""
            ripple
            flat
            >
            <v-icon left dark>arrow_back</v-icon>
            Back
        </v-btn>
    </v-toolbar>

    <v-container fluid>
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
                                        <v-btn primary flat type="submit">
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
                            @if (\Illuminate\Support\Facades\Request::all())
                            <v-btn flat warning href="{{ route('submissions.index') }}" class=""><v-icon left>remove_circle</v-icon> {{ __('Remove filters') }}</v-btn>
                            @endif
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
@endsection

@push('css')
    <style>
        .card--flex-toolbar {
            margin-top: -80px;
        }
        .fw-500 {
            font-weight: 500 !important;
        }
    </style>
@endpush

@push('pre-scripts')
    <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script>
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
