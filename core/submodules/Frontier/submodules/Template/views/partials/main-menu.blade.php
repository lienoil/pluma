<v-toolbar dark class="accent mb-3 elevation-1">
    <v-avatar tile>
        <img src="{{ $application->site->logo }}" alt="{{ $application->site->title }}">
    </v-avatar>
    <v-toolbar-title class="subheading white--text">
        <div>{{ $application->site->title }}</div>
        <div class="caption">{{ $application->site->tagline }}</div>
    </v-toolbar-title>
    <v-spacer></v-spacer>
    @include("Template::recursives.main-menu")
</v-toolbar>
