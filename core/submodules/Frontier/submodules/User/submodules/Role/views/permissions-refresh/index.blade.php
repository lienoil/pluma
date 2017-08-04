@extends("Frontier::layouts.admin")

@section("head-title", __("Refresh Permissions"))
@section("page-title", __("Refresh Permissions"))

@section("content")
    <v-card>
        <v-toolbar light class="elevation-0">
            <v-toolbar-title class="grey--text text--darken-2">{{ __('Permissions List') }}</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn primary class="white--text" v-on:click.native="refreshPermissions()">
                <v-icon dark>refresh</v-icon>
                <v-spacer></v-spacer>
                <span>Refresh</span>
            </v-btn>
        </v-toolbar>
        <v-list two-line>
            <template v-for="item in permissions.data">
                <v-list-tile v-bind:key="item.code" href="javascript:;" target="_blank">
                    <v-list-tile-content>
                        <v-list-tile-title v-html="item.code"></v-list-tile-title>
                        <v-list-tile-sub-title>@{{ item.name }} - @{{ item.description }}</v-list-tile-sub-title>
                    </v-list-tile-content>
                </v-list-tile>
            </template>
            <div class="text-xs-center">
                <v-pagination v-bind:length.number="permissions.total" v-model="permissions.current_page" total-visible="permissions.per_page"></v-pagination>
            </div>
        </v-list>
    </v-card>
@endsection

@push('pre-scripts')
    <script src="{{ assets('frontier/vendor/vue/resource/vue-resource.min.js') }}"></script>
    <script>
        Vue.use(VueResource);

        mixins.push({
            data () {
                return {
                    permissions: {!! json_encode($resources) !!},
                };
            },

            mounted () {
                this.initializePermissions();
            },

            methods: {
                initializePermissions () {
                    let url = '{{ route('api.permissions.all') }}';

                    this.$http.get(url).then(response => {
                        console.log(response);
                        this.permissions = response.data;
                    });
                },
                refreshPermissions () {
                    let url = '{{ route('api.permissions.refresh') }}';

                    this.$http.post(url).then(response => {
                        console.log(response);
                    });
                },
            },
        });
    </script>
@endpush
