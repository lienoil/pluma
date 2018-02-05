@if (! $resource->enrolled)
    <v-card ref="enroll-card" class="mb-3 elevation-1">
        <v-toolbar card class="transparent">
            <v-toolbar-title class="subheading page-title">{{ __('Availability') }}</v-toolbar-title>
            <v-spacer></v-spacer>
                <v-btn dark icon @click="$refs['enroll-card'].remove()"><v-icon>close</v-icon></v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        {{-- <v-card-media contain height="320px" class="pink lighten-3" src="{{ widgets('enrolled-to-this-course')->backdrop ?? '' }}"></v-card-media> --}}
        <v-card-text>
            <div class="text-xs-center">
                <v-icon class="grey--text  text--lighten-1 display-4">school</v-icon>
                <div>
                    @if ($resource->enrolled)
                        {{ __("You are currently enrolled to this course.") }}
                    @else
                        <span class="body-1 grey--text text--lighten-1"><em>{{ __("You are not enrolled to this course yet.") }}</em></span>
                    @endif
                </div>
            </div>
        </v-card-text>

        @if (! $resource->enrolled)
            <v-card-text class="text-xs-center">
                <v-btn ripple large primary class="px-4">{{ __("Get Course") }} <sup><v-icon class="caption">add</v-icon></sup></v-btn>
            </v-card-text>
        @endif
    </v-card>
@endif
