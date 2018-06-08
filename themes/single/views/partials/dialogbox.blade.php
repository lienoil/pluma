<v-dialog lazy :persistent="dialog.persistent" v-model="dialog.model" color="dialog.color" :max-width="dialog.maxWidth">
  <v-card :dark="theme.dark">
    <v-card-title v-html="trans(dialog.title)"></v-card-title>
    <v-card-text v-html="trans(dialog.text)"></v-card-text>
    <v-card-actions v-if="dialog.cancel || dialog.action">
      <v-spacer></v-spacer>
      <v-btn v-if="dialog.cancel" large @click.native="dialog.model = false" v-html="trans(dialog.cancelText)"></v-btn>
      <v-btn v-if="dialog.action" large @click.native="dialog.actionCallback()" color="primary" v-html="trans(dialog.actionText)"></v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
