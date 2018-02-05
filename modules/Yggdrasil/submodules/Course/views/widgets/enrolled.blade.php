@if (! $resource->enrolled)
    <v-card ref="enroll-card" dark class="mb-3 elevation-1 pink darken-1">
        <v-toolbar dark dense card class="transparent">
            <v-toolbar-title class="subheading page-title">{{ __('Availability') }}</v-toolbar-title>
            <v-spacer></v-spacer>
                <v-btn dark icon @click="$refs['enroll-card'].remove()"><v-icon>close</v-icon></v-btn>
        </v-toolbar>
        {{-- <v-card-media contain height="320px" class="pink lighten-3" src="{{ widgets('enrolled-to-this-course')->backdrop ?? '' }}"></v-card-media> --}}
        <v-card-text class="subheading">
            <div class="text-xs-center">
                <v-icon class="pink--text text--darken-3 display-4">school</v-icon>
                <div>
                    @if ($resource->enrolled)
                        {{ __("You are currently enrolled to this course.") }}
                    @else
                        {{ __("You are not enrolled to this course yet.") }}
                    @endif
                </div>
            </div>
        </v-card-text>
        @if (! $resource->enrolled)
            <v-card-actions>
                <v-spacer></v-spacer>
                @if (user())
                    <v-btn outline ripple class="white--text" href="{{ route('courses.enroll.index', [$resource->slug, user()->id]) }}">{{ __("Get Course") }} <sup><v-icon class="caption">add</v-icon></sup></v-btn>
                @endif
                <v-spacer></v-spacer>
            </v-card-actions>
        @endif
    </v-card>
@endif
