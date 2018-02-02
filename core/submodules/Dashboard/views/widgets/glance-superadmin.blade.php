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
                    v-tooltip:left="{ 'html':  glance.hidden ? '{{ __('Show Analytics') }}' : '{{ __('Hide Analytics') }}' }">
                    <v-icon>@{{ glance.hidden ? 'visibility' : 'visibility_off' }}</v-icon>
                </v-btn>
            </v-toolbar>

            <v-slide-y-transition>
                <v-card flat class="transparent" v-show="! glance.hidden" transition="slide-y-transition">
                    <v-card-text> --}}

                        <v-layout row wrap>
                            {{-- <v-flex sm3>
                                <v-card class="elevation-1 ma-1">
                                    <v-card-text>
                                        <p>{{ __("Hey there, " . user()->firstname . ".") }}</p>
                                        <p>{{ __("Here's some things to note since you left.") }}</p>
                                    </v-card-text>
                                </v-card>
                            </v-flex> --}}

                            <v-flex md3 sm6 xs12>
                                <v-card class="elevation-1 ma-1 text-xs-center">
                                    {{-- <v-card-media class="white--text" src="{{ assets('frontier/images/placeholder/ios_grad_2.jpg') }}"> --}}
                                    <v-card-media class="white--text" style="background: linear-gradient(45deg, rgb(2, 136, 209) 0%, rgb(38, 198, 218) 100%);">
                                        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                                        <v-layout column>
                                            <v-card dark class="text-xs-center elevation-0 transparent">
                                                <v-card-text>
                                                    <v-card-actions class="pa-0">
                                                        <v-avatar class="elevation-5 light-blue darken-2">
                                                            <img src="{{ assets('frontier/images/placeholder/glance-module.png') }}">
                                                        </v-avatar>
                                                        <v-spacer></v-spacer>
                                                        <div class="display-2 countup" data-target="{{ count(get_modules_path()) }}">0</div>
                                                    </v-card-actions>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <div class="subheading">{{ __('Modules') }}</div>
                                                    </v-card-actions>
                                                    <v-card-actions class="mb-2">
                                                        <v-spacer></v-spacer>
                                                        <v-btn dark outline class="pr-0" href="{{ route('users.index') }}">{{ __('Manage Modules') }}</v-btn>
                                                    </v-card-actions>
                                                </v-card-text>
                                            </v-card>
                                        </v-layout>
                                    </v-card-media>
                                </v-card>
                            </v-flex>

                            <v-flex md3 sm6 xs12>
                                <v-card class="elevation-1 ma-1 text-xs-center">
                                    <v-card-media class="white--text" style="background: linear-gradient(45deg, #FF5252 0%, #f48fb1 100%);">
                                        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                                        <v-layout column>
                                            <v-card dark class="text-xs-center elevation-0 transparent">
                                                <v-card-text>
                                                    <v-card-actions class="pa-0">
                                                        <v-avatar class="elevation-5 light-blue darken-2">
                                                            <img src="{{ assets('frontier/images/placeholder/glance-permission-1.png') }}">
                                                        </v-avatar>
                                                        <v-spacer></v-spacer>
                                                        <div class="display-2 countup" data-target="glance.visualizations.permissions.total" v-html="glance.visualizations.permissions.total"></div>
                                                    </v-card-actions>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <div class="subheading">{{ __('Permissions') }}</div>
                                                    </v-card-actions>
                                                    <v-card-actions class="mb-2">
                                                        <v-spacer></v-spacer>
                                                        <v-btn dark outline class="pr-0" href="{{ route('permissions.index') }}">{{ __('Check Permissions') }}</v-btn>
                                                    </v-card-actions>
                                                </v-card-text>
                                            </v-card>
                                        </v-layout>
                                    </v-card-media>
                                </v-card>
                            </v-flex>

                            <v-flex md3 sm6 xs12>
                                <v-card class="elevation-1 ma-1 text-xs-center">
                                    <v-card-media class="white--text" style="background: linear-gradient(45deg, #43A047 0%, #1de9b6 100%);">
                                        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                                            <v-layout column>
                                                <v-card dark class="text-xs-center elevation-0 transparent">
                                                    <v-card-text>
                                                        <v-card-actions class="pa-0">
                                                            <v-avatar class="elevation-5 cyan darken-3">
                                                                <img src="{{ assets('frontier/images/placeholder/glance-user-1.png') }}">
                                                            </v-avatar>
                                                            <v-spacer></v-spacer>
                                                            <div class="display-2 countup" data-target="glance.visualizations.users.total" v-html="glance.visualizations.users.total"></div>
                                                        </v-card-actions>
                                                        <v-card-actions>
                                                            <v-spacer></v-spacer>
                                                            <div class="subheading">{{ __('Users') }}</div>
                                                        </v-card-actions>
                                                        <v-card-actions class="mb-2">
                                                            <v-spacer></v-spacer>
                                                            <v-btn dark outline class="pr-0" href="{{ route('users.index') }}">{{ __('View Users') }}</v-btn>
                                                        </v-card-actions>
                                                    </v-card-text>
                                                </v-card>
                                            </v-layout>
                                    </v-card-media>
                                </v-card>
                            </v-flex>

                            <v-flex md3 sm6 xs12>
                                <v-card class="elevation-1 ma-1 text-xs-center">
                                    <v-card-media class="white--text" style="background: linear-gradient(45deg, #ff6f00 0%, #ffca28 100%);">
                                        <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                                        <v-layout column>
                                            <v-card dark class="text-xs-center elevation-0 transparent">
                                                <v-card-text>
                                                    <v-card-actions class="pa-0">
                                                        <v-avatar class="elevation-5 light-blue darken-2">
                                                            <img src="{{ assets('frontier/images/placeholder/glance-page.png') }}">
                                                        </v-avatar>
                                                        <v-spacer></v-spacer>
                                                        <div class="display-2 countup" data-target="glance.visualizations.pages.total" v-html="glance.visualizations.pages.total"></div>
                                                    </v-card-actions>
                                                    <v-card-actions>
                                                        <v-spacer></v-spacer>
                                                        <div class="subheading">{{ __('Pages') }}</div>
                                                    </v-card-actions>
                                                    <v-card-actions class="mb-2">
                                                        <v-spacer></v-spacer>
                                                        <v-btn dark outline class="pr-0" href="{{ route('pages.index') }}">{{ __('Add New') }}</v-btn>
                                                    </v-card-actions>
                                                </v-card-text>
                                            </v-card>
                                        </v-layout>
                                    </v-card-media>
                                </v-card>
                            </v-flex>
                        </v-layout>
                   {{-- </v-card-text>
                </v-card>
            </v-slide-y-transition>
        </v-card>
    </v-card-media>
</v-card> --}}

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
