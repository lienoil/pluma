<v-dialog lazy :persistent="dialog.persistent" v-model="dialog.model" color="dialog.color" :max-width="dialog.maxWidth">
  <v-card>
    <v-card-title v-if="dialog.title" v-html="trans(dialog.title)"></v-card-title>
    <v-card-text v-html="trans(dialog.text)"></v-card-text>

    <v-card-actions
      v-if="dialog.cancel || dialog.action"
      class="layout column wrap align-end"
      >
      <v-btn
        v-if="dialog.cancel"
        @click.native="dialog.model = false"
        class="layout column wrap justify-end mb-3"
        flat
        >
        Discard Changes
      </v-btn>
      <v-btn
        v-if="dialog.action"
        @click.native="dialog.actionCallback()"
        class="layout column wrap justify-end mb-3"
        flat
        >
        @{{ trans(dialog.actionText) }}
      </v-btn>
      <v-btn
        v-if="dialog.cancel"
        @click.native="dialog.model = false"
        class="layout column wrap justify-end mb-3"
        flat
        >
        @{{ trans(dialog.cancelText) }}
      </v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
