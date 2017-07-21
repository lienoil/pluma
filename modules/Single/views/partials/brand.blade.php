<template avatar>
    <v-list-tile-avatar>
        <img src="{{ $application->site->logo }}" alt="{{ $application->site->title }}" width="100%">
    </v-list-tile-avatar>
    <v-list-tile-content>
        <v-list-tile-title>@{{ application.site.title }}</v-list-tile-title>
    </v-list-tile-content>
    <v-list-tile-action right>
        <v-btn icon @click.native.stop="mini = !mini" :dark.sync="dark" :light.sync="light">
            <v-icon>chevron_left</v-icon>
        </v-btn>
    </v-list-tile-action>
</template>
