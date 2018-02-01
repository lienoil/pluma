@viewable(widgets('announcements'))
    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            <v-card class="elevation-1 mb-3 draggable-widget"
                v-show="!removeannouncement"
                transition="slide-y-transition">
                <v-card-media class="sortable-handle" src="{{ assets('frontier/images/placeholder/9.png') }}">
                    <div class="insert-overlay" style="background: rgba(56, 43, 80, 0.54); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
                    <v-layout column class="media">
                        <v-card-title class="subheading white--text">
                            {{-- <span class="pl-4 subheading">{{ __('Announcements') }}</span> --}}
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
                        <v-spacer></v-spacer>
                        <v-card-text v-show="!hideannouncement" class="white--text text-xs-center">
                            <div class="title pb-3">{{ __('Announcements') }}</div>
                            <div class="display-2 weight-600">{{ $announcements->count() }}</div>
                            <div class="body-2 white--text mb-3">{{ __('Total') }}</div>
                            @can('view-announcement')
                                <v-btn round dark outline dark href="{{ route('announcements.index') }}">{{ __('Manage Announcements') }}</v-btn>
                            @else
                                <v-btn round dark outline dark href="{{ route('announcements.all') }}">{{ __('View All') }}</v-btn>
                            @endcan
                        </v-card-text>
                    </v-layout>
                </v-card-media>
                <v-card-text v-show="!hideannouncement" class="pa-0">
                    @foreach ($announcements as $announcement)
                        <v-divider></v-divider>
                        <v-card flat class="transparent">
                            <v-toolbar card dense class="transparent">
                                <v-toolbar-title class="subheading primary--text">
                                    <a href="{{ route('announcements.single', $announcement->code) }}">
                                        <strong>{{ $announcement->name }}</strong>
                                    </a>
                                </v-toolbar-title>
                                <v-spacer></v-spacer>
                                @if ($announcement->category)
                                    <span class="caption grey--text">
                                        <v-icon left>{{ $announcement->category->icon }}</v-icon>
                                        {{ $announcement->categoryname }}
                                    </span>
                                @endif
                            </v-toolbar>
                            <v-card-text class="grey--text body-1">
                                @if ($announcement->feature)
                                    <v-card-media class="mb-2" height="100px" src="{{ $announcement->feature }}"></v-card-media>
                                @endif
                                {!! $announcement->body !!}
                            </v-card-text>
                            <v-card-actions class="grey--text body-1">
                                <div><v-icon left>access_time</v-icon> {{ $announcement->published }}</div>
                            </v-card-actions>
                        </v-card>
                    @endforeach
                </v-card-text>
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
