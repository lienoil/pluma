@viewable(widgets('announcements'))
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            <v-card class="elevation-1 mb-3 draggable-widget"
                v-show="!removeannouncement"
                transition="slide-y-transition">

                <v-card-media style="background: linear-gradient(45deg, #c32d60 0%, #00BCD4 100%)">
                    {{-- <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.20); position: absolute; width: 100%; height: 100%; z-index: 0;"></div> --}}
                    <v-layout row wrap>
                        <v-flex xs12>
                            <v-card class="elevation-0 transparent sortable-handle">
                                <v-card-title class="subheading white--text">
                                    <v-spacer></v-spacer>
                                    <v-menu bottom left>
                                        <v-btn icon class="white--text" slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                                       <v-list>
                                            <v-list-tile @click="removeannouncement = !removeannouncement" ripple>
                                                <v-list-tile-action>
                                                    <v-icon error class="error--text">remove_circle</v-icon>
                                                </v-list-tile-action>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>
                                                        {{ __('Remove') }}
                                                    </v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                            <v-list-tile @click="setStorage('widgets.hideannouncement', (hideannouncement = !hideannouncement))" ripple>
                                                <v-list-tile-action>
                                                    <v-icon class="grey--text">@{{ hideannouncement ? 'visibility' : 'visibility_off' }}</v-icon>
                                                </v-list-tile-action>
                                                <v-list-tile-content>
                                                    <v-list-tile-title>
                                                        @{{ hideannouncement ? 'Show' : 'Hide' }}
                                                    </v-list-tile-title>
                                                </v-list-tile-content>
                                            </v-list-tile>
                                        </v-list>
                                    </v-menu>
                                </v-card-title>
                                <v-card-text v-show="!hideannouncement">
                                    {{-- banner --}}
                                    <div class="text-xs-center title pb-3 white--text">{{ __('Announcements') }}</div>
                                    <div class="text-xs-center display-3 weight-600 white--text">{{ $announcements->count() }}</div>
                                    <div class="text-xs-center body-2 white--text mb-3">{{ __('Over All') }}</div>
                                    <div class="text-xs-center">
                                        @can('view-announcement')
                                            <v-btn round dark outline dark href="{{ route('announcements.index') }}">{{ __('Manage Announcements') }}</v-btn>
                                        @else
                                            <v-btn round dark outline dark href="{{ route('announcements.all') }}">{{ __('View All') }}</v-btn>
                                        @endcan
                                    </div>
                                    {{-- /banner --}}

                                    {{-- list of announcements --}}
                                    @foreach ($announcements as $announcement)
                                    <div class="white mt-3 elevation-3" style="border-radius: 8px;">
                                        <div v-show="!hideannouncement">
                                            <div class="subheading pa-3">
                                                <a class="td-n grey--text text--darken-1 mb-2" href="{{ route('announcements.single', $announcement->code) }}">
                                                    <strong>{{ $announcement->name }}</strong>
                                                </a>
                                                @if ($announcement->category)
                                                    <div class="mb-2">
                                                        <span class="caption grey--text">
                                                            <v-icon left>{{ $announcement->category->icon }}</v-icon>
                                                            {{ $announcement->categoryname }}
                                                        </span>
                                                    </div>
                                                @endif
                                                <div class="my-3">
                                                    @if ($announcement->feature)
                                                        <v-card-media class="mb-2" height="100px" src="{{ $announcement->feature }}"></v-card-media>
                                                    @endif
                                                </div>
                                                {!! $announcement->body !!}

                                                <div class="body-1 grey--text"><v-icon left>access_time</v-icon> {{ $announcement->published }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    {{-- /list of announcements --}}
                                </v-card-text>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-card-media>
            </v-card>
        </v-slide-y-transition>
    </draggable>

    @push('pre-scripts')
        <script>
            mixins.push({
                data () {
                    return {
                        removeannouncement: this.getStorage('widgets.removeannouncement') === "true",
                        hideannouncement: this.getStorage('widgets.hideannouncement') === "true",
                    }
                }
            });
        </script>
    @endpush
@endviewable
