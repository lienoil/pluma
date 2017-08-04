@extends("Frontier::layouts.admin")

@push('utilitybar')
    <a class="btn btn--raised primary white--text" href="{{ route('pages.create') }}">Create</a>
@endpush

@section("content")
    <v-layout row wrap>
        <v-flex>
            <v-card>
                <v-card-title>
                    <span>{{ __('All Pages') }}</span>
                    <v-spacer></v-spacer>
                    <v-text-field
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                        v-model="search"
                    ></v-text-field>
                </v-card-title>
                <v-data-table
                    v-bind:headers="headers"
                    v-bind:items="items"
                    v-bind:search="search"
                >
                    <template slot="items" scope="page">
                        <td><strong>@{{ page.item.title }}</strong></td>
                        <td>@{{ page.item.slug }}</td>
                        <td>@{{ page.item.excerpt }}</td>
                        <td>@{{ page.item.created }}</td>
                    </template>
                </v-data-table>
            </v-card>
        </v-flex>
    </v-layout>
@endsection

@push('pre-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.min.js"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    search: '',
                    pagination: {},
                    headers: [
                        { text: 'Title', align: 'left', value: 'title' },
                        { text: 'Slug', align: 'center', value: 'slug' },
                        { text: 'Excerpt', align: 'center', value: 'excerpt' },
                        { text: 'Last Modified', align: 'center', value: 'modified' },
                    ],
                    items: [],
                    pages: null,
                };
            },
            methods: {
                getAllPages: function () {
                    this.$http.get('/api/pages/all?paginate=15&next=1').then((response) => {
                        this.items = response.data.data;
                    });
                },
            },
            mounted () {
                this.getAllPages();
            }
        });
    </script>

@endpush
