<v-dialog lazy :persistent="dialog.persistent" v-model="dialog.model" color="dialog.color" :max-width="dialog.maxWidth">
  <v-card :dark="theme.dark">
    <v-card-title v-html="trans(dialog.title)"></v-card-title>
    <v-card-text v-html="trans(dialog.text)"></v-card-text>
    <v-card-actions class="layout column wrap justify-end align-end" v-if="dialog.cancel || dialog.action">
      <v-btn block class="text-xs-right" flat v-if="dialog.cancel" @click.native="dialog.model = false">Discard Changes</v-btn>
      <v-btn block class="text-xs-right" flat v-if="dialog.action" @click.native="dialog.actionCallback()">@{{ trans(dialog.actionText) }}</v-btn>
      <v-btn block class="text-xs-right" flat v-if="dialog.cancel" @click.native="dialog.model = false">@{{ trans(dialog.cancelText) }}</v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
