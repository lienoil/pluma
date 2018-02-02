<v-layout ref="evaluation-card" row wrap>
    <v-flex flex xs12 sm12>
        <v-card dark class="elevation-1 mb-3 secondary">
            <v-toolbar dark dense card class="transparent">
                <v-toolbar-title class="page-title">{{ __('Course Evaluation') }}</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn dark icon @click="$refs['evaluation-card'].remove()"><v-icon>close</v-icon></v-btn>
            </v-toolbar>
            <v-card-text class="body-1 text-xs-center">
                <v-icon class="display-4 white--text text--darken-4">check</v-icon>
                <p class="subheading">{{ __("You've finished this course! Yey!") }}</p>
                <p>{{ __('How did we do? Let us know by answering this quick evaluation form.') }}</p>
                <p>{{ __("It will only take a moment. Click the button below to start.") }}</p>
                <v-btn target="_blank" primary href="">
                    {{ __('Start Course Feedback') }}
                    <sup>&nbsp;<v-icon class="caption">fa-external-link</v-icon></sup>
                </v-btn>

            </v-card-text>
            <v-alert info v-show="'true'">{{ __('You are seeing this message because you have finished the course (yey!). Answering the evaluation survey form will help us improve it and its related topics.') }}</v-alert>
        </v-card>
    </v-flex>
</v-layout>
