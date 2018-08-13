@viewable('assignments')

    <draggable
        class="sortable-container"
        :options="{animation: 150, handle: '.sortable-handle', group: 'widgets', draggable: '.draggable-widget', forceFallback: true}"
    >
        <v-slide-y-transition>
            <v-card v-show="!removeassignment" transition="slide-y-transition" class="elevation-1 mb-3 draggable-widget">
                <v-toolbar flat class="transparent sortable-handle">
                    <v-toolbar-title class="page-title subheading">{{ __('Assignments') }}</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-menu bottom left>
                        <v-btn icon slot="activator" v-tooltip:left="{ html: 'More Actions' }"><v-icon>more_vert</v-icon></v-btn>
                       <v-list>
                            <v-list-tile @click="removeassignment = !removeassignment"
                                ripple
                                v-bind:ripple="{ class: 'indigo--text text--darken-2' }">
                                <v-list-tile-action>
                                    <v-icon error class="error--text">remove_circle</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        {{ __('Remove') }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                            <v-list-tile @click="setStorage('widget.hideassignment', (hideassignment = !hideassignment))"
                                ripple
                                v-bind:ripple="{ class: 'indigo--text text--darken-2' }">
                                <v-list-tile-action>
                                    <v-icon class="grey--text">@{{ hideassignment ? 'visibility' : 'visibility_off' }}</v-icon>
                                </v-list-tile-action>
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                        @{{ hideassignment ? 'Show' : 'Hide' }}
                                    </v-list-tile-title>
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </v-toolbar>

                {{-- <v-divider></v-divider> --}}

                {{-- list of assignments --}}
                <div v-show="!hideassignment">
                    {{-- <v-divider></v-divider> --}}


                    @if (is_null($assignments))
                        <v-card flat class="text-xs-center grey lighten-4">
                            <v-card-text class="pa-5 grey--text">
                                <div class="mb-3">
                                    <img class="empty_states--opacity" width="80px" src="{{ assets('frontier/images/empty_states/assignments.svg') }}" alt="">
                                </div>
                                <div>{!! __('No assignments to show.') !!}</div>
                            </v-card-text>
                        </v-card>
                    @else

                        @foreach ($assignments as $assignment)
                        <v-card-text>
                            <div class="subheading">
                                <a class="td-n secondary--text" href="">
                                    <strong>{{ $assignment->title }}</strong>
                                </a>
                                <p class="body-2"><span class="grey--text">{{ __('Deadline:') }}</span> {{ $assignment->deadline }}</p>
                                @if ($assignment->category)
                                    <div class="mb-2">
                                        <span class="caption grey--text">
                                            <v-icon left>{{ $assignment->category->icon }}</v-icon>
                                            {{ $assignment->categoryname }}
                                        </span>
                                    </div>
                                @endif
                                <div class="my-4">
                                    @if ($assignment->feature)
                                        <v-card-media class="mb-2" height="100px" src="{{ $assignment->feature }}"></v-card-media>
                                    @endif
                                </div>
                                {!! $assignment->body !!}
                            </div>
                        </v-card-text>
                        @endforeach
                        <v-divider></v-divider>
                        @endif
                    </v-card-text>
                </div>
                {{-- list of assignments --}}
            </v-card>
        </v-slide-y-transition>
    </draggable>

    @push('pre-scripts')
        <script>
            mixins.push({
                data () {
                    return {
                        removeassignment: this.getStorage('widgets.removeassignment') === "true",
                        hideassignment: this.getStorage('widgets.hideassignment') === "true",
                    }
                }
            });
        </script>
    @endpush
@endviewable
