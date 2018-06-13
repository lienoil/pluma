<template>
  <v-dialog
    max-width="280px"
    lazy
    v-model="dialogbox.model"
    >
    <v-card>
      <v-card-title v-if="dialogbox.title" v-html="trans(dialogbox.title)"></v-card-title>
      <v-card-text v-if="dialogbox.text" v-html="trans(dialogbox.text)"></v-card-text>

      <v-card-actions
        v-if="dialogbox.cancel || dialogbox.action"
        :class="{'layout column wrap align-end': dialogbox.discard}"
        >
        <v-btn
          v-if="dialogbox.cancel"
          @click.native="dialogbox.model = false"
          class="layout column wrap justify-end mb-3"
          flat
          >
          Discard Changes
        </v-btn>
        <v-btn
          v-if="dialogbox.action"
          @click.native="dialogbox.actionCallback()"
          class="layout column wrap justify-end mb-3"
          flat
          >
          @{{ trans(dialogbox.actionText) }}
        </v-btn>
        <v-btn
          v-if="dialogbox.cancel"
          @click="hideDialogbox"
          class="layout column wrap justify-end mb-3"
          flat
          >
          @{{ trans(dialogbox.cancelText) }}
        </v-btn>
      </v-card-actions>
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
