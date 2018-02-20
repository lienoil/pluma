<v-card class="elevation-1">
    <v-toolbar card class="transparent">
        <v-toolbar-title class="page-title subheading accent--text">{{ __('Assignment') }}</v-toolbar-title>
        <v-spacer></v-spacer>
    </v-toolbar>

    <v-divider></v-divider>

    @if (is_null($lesson->assignment))
        <v-card-text class="pa-5 text-xs-center red--text text--lighten-3">
            <v-icon class="display-4 red--text text--lighten-3">content_copy</v-icon>
            <div label class="body-1">
                {!! __('No assignment<br>for this lesson.') !!}
            </div>
        </v-card-text>
    @else
        <v-card-text class="pa-3 grey--text text--darken-2">
            <div class="mb-4"><strong>{{ $lesson->assignment->title }}</strong></div>
            <div class="page-content body-1">{!! $lesson->assignment->body !!}</div>
            <div class="text-xs-right">
                <v-icon left class="subheading">fa-edit</v-icon>
                {{ __('Deadline') }}: {{ $lesson->assignment->deadline }}
            </div>
            <v-card flat tile>
                llasd
            </v-card>
        </v-card-text>
    @endif

    @if ($lesson->assignment)
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn disabled ripple v-tooltip.bottom="{html:'{{ __('Download Assignment') }}'}">
                <v-icon>file_download</v-icon>
                {{ __('Download') }}
            </v-btn>
        </v-card-actions>
    @endif
</v-card>
