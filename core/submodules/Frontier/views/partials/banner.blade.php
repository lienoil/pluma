<v-alert
    :hide-icon="true"
    icon="priority_high"
    info
    dismissible
    transition="slide-y-reverse-transition"
    v-model="alert.model"
    value="true"
>
    <v-card style="margin-bottom: -2rem;" class="elevation-1 mb--2" min-height="500px">
        <v-card-title class="headline">{{ __($title) }} <v-btn icon></v-btn></v-card-title>
        <v-card-text>
            <p>{{ __($content) }}</p>
        </v-card-text>
    </v-card>
</v-alert>
