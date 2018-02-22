{{-- <v-card class="elevation-1">
    <v-toolbar class="elevation-0 transparent">
        <v-toolbar-title>{{ __("Progress") }}</v-toolbar-title>
    </v-toolbar>
    <v-divider></v-divider>
    <v-card-text class=" text-xs-center">
        <div class="text-xs-center">
            <v-progress-circular
                v-bind:size="150"
                v-bind:width="20"
                v-bind:value="value"
<<<<<<< HEAD
                class="indigo--text text--lighten-2"
=======
                class="blue--text text--lighten-2"
>>>>>>> dev
                >
                @{{ value }}
            </v-progress-circular>
        </div>
    </v-card-text>
<<<<<<< HEAD
    <v-card-text class="text-xs-center indigo lighten-1">
=======
    <v-card-text class="text-xs-center blue lighten-1">
>>>>>>> dev
        <div>
            <v-subheading class="white--text">Lesson Complete:</v-subheading>
        </div>
        <div >
            <v-subheading class="white--text">0/2</v-subheading>
        </div>
    </v-card-text>
</v-card> --}}

{{-- @viewable(widgets('course-progress')) --}}
    <v-card class="elevation-1">
        <v-toolbar card class="transparent">
            <v-toolbar-title class="page-title subheading accent--text">{{ __('Your Progress') }}</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text class="text-xs-center">
            <v-spacer></v-spacer>
            @if ($resource->enrolled)
                <v-progress-circular
                    :size="150"
                    :width="20"
                    :value="{{ $lesson->progress }}"
<<<<<<< HEAD
                    class="secondary--text text--lighten-3"
=======
                    class="blue--text text--lighten-3"
>>>>>>> dev
                >
                    <span>{{ $lesson->progress }}%</span>
                </v-progress-circular>
            @else
                <v-progress-circular
                    :size="150"
                    :width="20"
                    :value="0"
<<<<<<< HEAD
                    class="secondary--text text--lighten-3"
=======
                    class="blue--text text--lighten-3"
>>>>>>> dev
                >
                    <span>{{ __('00%') }}</span>
                </v-progress-circular>
                <div class="body-1 grey--text">{{ __('Login to view your progress.') }}</div>
                <v-btn flat primary href="{{ route('login.show', ['redirect_to' => route('courses.show', $resource->slug)]) }}">{{ __('Login') }}</v-btn>
            @endif
            <v-spacer></v-spacer>
        </v-card-text>
<<<<<<< HEAD
        <v-card-text class="secondary lighten-4 white--text text-xs-center">
=======
        <v-card-text class="blue lighten-4 white--text text-xs-center">
>>>>>>> dev
            <div class="headline">{{ $lesson->completed . __(" of ") . $lesson->contents->count() }}</div>
            <div class="subheading">{{ __('Contents Completed') }}</div>
        </v-card-text>
    </v-card>
{{-- @endviewable --}}
