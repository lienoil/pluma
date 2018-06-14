<template>
  <v-dialog
    :persistent="dialogbox.persistent"
    max-width="290px"
    lazy
    v-model="dialogbox.model"
    >
    <v-card>
      <v-card-title v-if="dialogbox.title" v-html="trans(dialogbox.title)"></v-card-title>
      <v-card-text v-if="dialogbox.text" v-html="trans(dialogbox.text)"></v-card-text>

      <v-card-actions
        v-if="dialogbox.cancel || dialogbox.action"
        :class="dialogbox.discard ? `layout column wrap align-end` : `flex row wrap`"
        >
        <v-btn
          v-if="dialogbox.discardText || dialogbox.discard"
          :class="dialogbox.discard ? `layout column wrap align-end` : `flex row wrap`"
          :color="dialogbox.discardColor"
          @click.native="dialogbox.discardCallback()"
          flat
          >
          {{ trans(dialogbox.discardText) }}
        </v-btn>
        <v-btn
          v-if="dialogbox.action"
          :class="dialogbox.discard ? `layout column wrap align-end` : `flex row wrap order-xs2`"
          :color="dialogbox.actionColor"
          @click.native="dialogbox.actionCallback()"
          flat
          >
          {{ trans(dialogbox.actionText) }}
        </v-btn>
        <v-btn
          v-if="dialogbox.cancel"
          :class="dialogbox.discard ? `layout column wrap align-end` : `flex row wrap order-xs1`"
          :color="dialogbox.cancelColor"
          @click="dialogbox.cancelCallback() || hide()"
          flat
          >
          {{ trans(dialogbox.cancelText) }}
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
    },

    hide () {
      this.$store.dispatch('dialogbox/PROMPT_DIALOG', { model: false })
    }
  }
}
</script>
