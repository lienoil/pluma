<v-dialog v-model="dialog.model" persistent>
    <v-card>
        <v-card-title class="headline">
            <v-icon v-if="dialog.icon">{{ dialog.icon }}</v-icon>
            {{ dialog.title }}
        </v-card-title>
        <v-card-text>{{ dialog.description }}</v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn class="darken-1" flat="flat" @click.native="dialog.cancelHandler()">{{ dialog.no }}</v-btn>
            <v-btn class="error--text darken-1" flat="flat" @click.native="dialog.confirmHandler()">{{ dialog.yes }}</v-btn>
        </v-card-actions>
  </v-card>
</v-dialog>
