<v-container fluid grid-list-lg>

{{-- <v-card class="elevation-1">
    <v-card-media src="{{ widgets()->glance->backdrop }}">
        <v-card flat class="transparent" style="width:100%">
            <div class="insert-overlay"
                style="background: rgba(9, 53, 74, 0.95); position: absolute; width: 100%; height: 100%;"></div>

            <v-toolbar card class="transparent">
                <v-spacer></v-spacer>
                <v-btn dark icon href="#">
                    <v-icon>file_download</v-icon>
                </v-btn>
                <v-btn dark icon @click="setStorage('glance.hidden', (glance.hidden = !glance.hidden))"
                    v-tooltip:left="{ 'html':  glance.hidden ? 'Show Analytics' : 'Hide Analytics' }">
                    <v-icon>@{{ glance.hidden ? 'visibility' : 'visibility_off' }}</v-icon>
                </v-btn>
            </v-toolbar>

            <v-slide-y-transition>
                <v-card flat class="transparent" v-show="! glance.hidden" transition="slide-y-transition">
                    <v-card-text> --}}

                        <v-layout row wrap>

                            {{-- <v-flex sm3>
                                <v-card class="elevation-1 mb-3 ma-1">
                                    <v-card-text>
                                        <p>{{ __("Hey there, " . user()->firstname . ".") }}</p>
                                        <p>{{ __("Here's some things to note since you left.") }}</p>
                                    </v-card-text>
                                </v-card>
                            </v-flex> --}}

                            <v-flex sm3 xs6>
                                <v-card class="elevation-1 mb-3 ma-1 text-xs-center">
                                    <v-card-media class="white--text" src="{{ assets('frontier/images/placeholder/ios_grad_2.jpg') }}">
                                    {{-- <v-card-media class="white--text" style="background: linear-gradient(140deg, rgb(64, 182, 206) 42%, rgb(111, 106, 210) 88%)"> --}}
                                        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                                        <v-layout column justify-center align-center>
                                            <v-card dark class="text-xs-center elevation-0 transparent">
                                                <v-card-text>
                                                    {{-- <v-icon class="display-3 grey--text text--lighten-4">chrome_reader_mode</v-icon> --}}
                                                    <div class="display-3 mb-3 countup" data-target="{{ count(get_modules_path()) }}">0</div>
                                                    <div class="title mb-3">{{ __('Modules') }}</div>
                                                    <div class="mb-3"><v-btn class="indigo lighten-2" dark outline href="{{ route('users.index') }}">{{ __('Manage Modules') }}</v-btn></div>
                                                </v-card-text>
                                            </v-card>
                                        </v-layout>
                                    </v-card-media>
                                </v-card>
                            </v-flex>

                            <v-flex sm3 xs6>
                                <v-card class="elevation-1 mb-3 ma-1 text-xs-center">
                                    <v-card-media class="white--text" style="background: linear-gradient(140deg, #cf7496 36%, #8868c1 88%);">
                                        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                                        <v-layout column justify-center align-center>
                                            <v-card dark class="text-xs-center elevation-0 transparent">
                                                <v-card-text>
                                                    {{-- <v-icon class="display-3 grey--text text--lighten-4">chrome_reader_mode</v-icon> --}}
                                                    <div class="display-3 mb-3 countup" data-target="glance.visualizations.permissions.total" v-html="glance.visualizations.permissions.total"></div>
                                                    <div class="title mb-3">{{ __('Permissions') }}</div>
                                                    <div class="mb-3"><v-btn class="purple lighten-3" dark outline href="{{ route('permissions.index') }}">{{ __('Check Permissions') }}</v-btn></div>
                                                </v-card-text>
                                            </v-card>
                                        </v-layout>
                                    </v-card-media>
                                </v-card>
                            </v-flex>

                            <v-flex sm3 xs6>
                                <v-card class="elevation-1 mb-3 ma-1 text-xs-center">
                                    <v-card-media class="white--text" style="background: linear-gradient(140deg, #41b1bf 36%, #1d70b3 88%);">
                                        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                                        <v-layout column justify-center align-center>
                                            <v-card dark class="text-xs-center elevation-0 transparent">
                                                <v-card-text>
                                                    {{-- <v-icon class="display-3 grey--text text--lighten-4">chrome_reader_mode</v-icon> --}}
                                                    <div class="display-3 mb-3 countup" data-target="glance.visualizations.users.total" v-html="glance.visualizations.users.total"></div>
                                                    <div class="title mb-3">{{ __('Users') }}</div>
                                                    <div class="mb-3"><v-btn class="teal lighten-2" dark outline href="{{ route('users.index') }}">{{ __('View Users') }}</v-btn></div>
                                                </v-card-text>
                                            </v-card>
                                        </v-layout>
                                    </v-card-media>
                                </v-card>
                            </v-flex>

                            <v-flex sm3 xs6>
                                <v-card class="elevation-1 mb-3 ma-1">
                                    <v-card-text class="primary--text text-xs-center">
                                        <v-icon class="primary--text display-3">insert_drive_file</v-icon>
                                        <div class="display-3 lh-1 countup" :data-target="glance.visualizations.pages.total" v-html="glance.visualizations.pages.total"></div>
                                        <div class="body-1">{{ __('Pages') }}</div>
                                    </v-card-text>
                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn primary flat href="{{ route('pages.create') }}">{{ __('Add New') }}</v-btn>
                                        <v-spacer></v-spacer>
                                    </v-card-actions>
                                </v-card>
                            </v-flex>

                        </v-layout>
{{--
                    </v-card-text>
                </v-card>
            </v-slide-y-transition>

        </v-card>
    </v-card-media>
</v-card> --}}
</v-container>

@push('pre-scripts')
    <script src="{{ assets('frontier/js/countup.min.js') }}"></script>
    <script>
        mixins.push({
            data () {
                return {
                    glance: {
                        visualizations: {
                            users: {
                                items: [],
                                total: 0,
                            },
                            pages: {
                                items: [],
                                total: 0,
                            },
                            permissions: {
                                items: [],
                                total: 0,
                            },
                        },
                    },
                };
            },

            methods: {
                getVisualizations () {
                    let self = this;
                    let query = {
                        take: '-1',
                    };

                    self.api().get('{{ route('api.users.all') }}', query).then(response => {
                        self.glance.visualizations.users.items = response.items.data;
                        self.glance.visualizations.users.total = response.items.total;
                    });

                    setTimeout(function () {
                        self.api().get('{{ route('api.pages.all') }}', query).then(response => {
                            self.glance.visualizations.pages.items = response.items.data;
                            self.glance.visualizations.pages.total = response.items.total;
                        });
                    }, 800);

                    setTimeout(function () {
                        self.api().get('{{ route('api.permissions.all') }}', query).then(response => {
                            self.glance.visualizations.permissions.items = response.items.data;
                            self.glance.visualizations.permissions.total = response.items.total;
                        });
                    }, 1200);

                    setTimeout(function () {
                        document.querySelectorAll('.countup').forEach(item => {
                            // alert(item.getAttribute('data-target'));
                            var counter = new CountUp(item, 0, item.getAttribute('data-target'));

                            if (! counter.error) {
                                counter.start();
                            }
                        });
                    }, 1600);
                }
            },

            mounted () {
                this.getVisualizations();
            }
        })
    </script>
@endpush
