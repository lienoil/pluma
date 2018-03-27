<v-card class="elevation-1">
    <v-card-media dark src="{{ widgets('enrolled-students')->backdrop ?? assets('frontier/images/placeholder/learner.png') }}">
        <div class="insert-overlay" style="background: rgba(0, 0, 0, 0.6); position: absolute; width: 100%; height: 100%; z-index: 0;"></div>
        <v-layout column wrap class="ma-3 mt-0">
            <v-card class="elevation-0 transparent">
                <v-card-text class="white--text text-xs-center">
                    <div class="display-3 white--text">{{ $resource->students->count() }}</div>
                    <div class="headline white--text">{{ $resource->students->count() <= 1 ? __('Learner') : __('Learners') }}</div>
                    <div class="body-1 white--text mb-3">{{ __('taking this course') }}</div>

                    <v-btn round outline class="white--text"
                    href="{{ route('courses.students', $resource->slug) }}"
                        v-tooltip:bottom="{ html: 'View list of students enrolled' }">
                        {{ __('View All') }}
                    </v-btn>
                </v-card-text>
            </v-card>
        </v-layout>
    </v-card-media>
    {{-- <v-divider></v-divider> --}}

    {{-- s --}}
    <v-card-text class="pa-0">
        <v-list subheader style="height: 500px; min-height: scroll;">
            <v-subheader class="mt-2 ml-2">
                {{ __('List of learners and their progress') }}
            </v-subheader>
            @foreach ($resource->students as $student)
                <v-list-tile avatar ripple>
                    <v-list-tile-avatar>
                        <img src="{{ $student->avatar }}" alt="">
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            {{ $student->displayname }}
                        </v-list-tile-title>
                    </v-list-tile-content>
                    <v-list-tile-action class="grey--text">
                        {{ $student->courses()->find($resource->id)->progress }}
                    </v-list-tile-action>
                </v-list-tile>
            @endforeach
        </v-list>
    </v-card-text>
    {{-- s --}}

    <v-card-text class="pa-0">
        <v-list subheader style="height: 500px; overflow-y: scroll;">
            <v-subheader class="mt-2 ml-2">{{ __('List of learners and their progress') }}:</v-subheader>
            @foreach ($resource->students as $student)
                {{-- TODO: click, href go to students profile page, course progress --}}
                <v-list-tile avatar ripple>
                    <v-list-tile-avatar>
                        <img src="{{ $student->avatar }}">
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title>{{ $student->displayname }}</v-list-tile-title>
                    </v-list-tile-content>
                    <v-list-tile-action class="grey--text">
                        {{ $student->courses()->find($resource->id)->progress }}
                    </v-list-tile-action>
                </v-list-tile>
            @endforeach
        </v-list>
    </v-card-text>
</v-card>
