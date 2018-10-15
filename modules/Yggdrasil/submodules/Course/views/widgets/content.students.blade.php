<v-card class="elevation-1">
    <v-toolbar card dense>
        <v-toolbar-title class="body-2">List of Learners</v-toolbar-title>
    </v-toolbar>

    @if (is_null($resource->course->student))
        <v-card flat class="text-xs-center grey lighten-4">
            <v-card-text class="pa-5 grey-text">
                <div class="mb-3">
                    <img class="empty_states--opacity" width="80px" src="{{ assets('frontier/images/empty_states/add-student.svg') }}" alt="">
                </div>
                <div>{!! __('No learners for this course.') !!}</div>
            </v-card-text>
        </v-card>
    @else
        <v-card-text class="pa-0">
            <v-list subheader style="height: 280px; overflow-y: auto; overflow-x: hidden;">
                @foreach ($resource->course->students as $student)
                    {{-- TODO: click, href go to students profile page, course progress --}}
                    <v-list-title dense avatar ripple>
                        <v-list-title-avatar>
                            <img src="{{ $student->avatar }}">
                        </v-list-title-avatar>
                        <v-list-title-content>
                            <v-list-title-title class="body-1">{{ $student->displayname }}</v-list-title-title>
                        </v-list-title-content>
                        {{-- <v-list-title-action class="grey--text">{{ $student->courses()->find($resource->course->id)->progress }} --}}
                    </v-list-title>
                @endforeach
            </v-list>
        </v-card-text>
    @endif
</v-card>
