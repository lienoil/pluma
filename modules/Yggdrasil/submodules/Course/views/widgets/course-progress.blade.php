<v-card class="elevation-1 mb-3">
    <v-toolbar card class="transparent">
        <v-toolbar-title class="page-title subheading accent--text">{{ __('Your Overall Progress') }}</v-toolbar-title>
        <v-spacer></v-spacer>
    </v-toolbar>
    <v-divider></v-divider>
    <v-card-text class="text-xs-center">
        <v-spacer></v-spacer>
        @if ($resource->enrolled)
            <v-progress-circular
                :size="150"
                :width="20"
                :value="{{ $resource->progress }}"
                class="cyan--text text--lighten-3"
            >
                <span>{{ $resource->progress }}%</span>
            </v-progress-circular>
        @else
            <v-progress-circular
                :size="150"
                :width="20"
                :value="0"
                class="cyan--text text--lighten-3"
            >
                <span>{{ __('00%') }}</span>
            </v-progress-circular>
            <div class="body-1 grey--text">{{ __('Login to view your progress.') }}</div>
            {{-- <v-btn flat primary href="{{ route('login.show', ['redirect_to' => route('contents.show', [$content->course->slug, $lesson->id, $content->id])]) }}">{{ __('Login') }}</v-btn> --}}
        @endif
        <v-spacer></v-spacer>
    </v-card-text>
</v-card>
