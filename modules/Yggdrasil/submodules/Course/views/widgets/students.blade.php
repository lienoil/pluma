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
    <v-divider></v-divider>

    @if (is_null($resource->student))
        <v-card-text class="pa-5 text-xs-center red--text text--lighten-3">
            <v-icon class="display-1 red--text text--lighten-3 mb-3">supervisor_account</v-icon>
            <div label class="body-1">
                {!! __('No learners <br> for this course.') !!}
            </div>
        </v-card-text>
    @else
        <v-card-text class="pa-0">
            <v-list subheader style="height: 500px; overflow-y: scroll; overflow-x: hidden;">
                @foreach ($resource->students as $student)
                    {{-- TODO: click, href go to students profile page, course progress --}}
                    <v-list-title dense avatar ripple>
                        <v-list-title-avatar>
                            <img src="{{ $student->avatar }}">
                        </v-list-title-avatar>
                        <v-list-title-content>
                            <v-list-title-title class="body-1">{{ $student->displayname }}</v-list-title-title>
                        </v-list-title-content>
                    </v-list-title>
                @endforeach
            </v-list>
        </v-card-text>
    @endif
</v-card>
