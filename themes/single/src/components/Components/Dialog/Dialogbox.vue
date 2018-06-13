<template>
  <v-dialog
    max-width="280px"
    lazy
    v-model="dialogbox.model"
    >
    <v-card>
      <!-- <v-card-title v-html="trans(dialog.title)"></v-card-title>
      <v-card-text v-html="trans(dialog.text)"></v-card-text> -->

      <!-- <v-card-actions
        v-if="dialog.cancel || dialog.action"
        :class="{'layout column wrap align-end': dialog.discard}"
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
          @click="hideDialogbox"
          class="layout column wrap justify-end mb-3"
          flat
          >
          @{{ trans(dialog.cancelText) }}
        </v-btn>
      </v-card-actions> -->
    </v-card>
  </v-dialog>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'Dialogbox',
  computed: {
    ...mapGetters({
      dialogbox: 'dialogbox/dialogbox'
    })
  },
  methods: {
    show () {
      this.$store.dispatch('dialogbox/PROMPT_DIALOG', { model: true })
    }
  }
}
</script>
