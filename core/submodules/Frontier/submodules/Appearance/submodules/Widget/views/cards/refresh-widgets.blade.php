<form action="{{ route('widgets.refresh') }}" method="POST">
    {{ csrf_field() }}
    <v-card class="elevation-1 mb-3">
        <v-toolbar card class="transparent">
            <v-toolbar-title class="subheading">{{ __("Refresh Widgets") }}</v-toolbar-title>
        </v-toolbar>
        <v-card-text class="grey--text text--lighten-1 body-1">
            {{ __("Here, you may refresh the widgets. This is useful if new modules that supports widgets were installed.") }}
        </v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn type="submit" primary class="elevation-1">{{ __('Refresh') }}</v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
    </v-card>
</form>
