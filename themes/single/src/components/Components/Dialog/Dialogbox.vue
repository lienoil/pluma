<template>
  <v-dialog
    :persistent="dialogbox.persistent"
    max-width="450px"
    lazy
    v-model="dialogbox.model"
    v-shortkey="['esc']" @shortkey.native="dialogbox.cancelCallback() || hide()"
    >
    <v-card :class="{ 'text-xs-center': dialogbox.alignedCenter }">
      <v-card-text>
        <v-icon
          class="icon--xlarge"
          :class="dialogbox.iconColor"
          v-html="dialogbox.icon"
          v-if="dialogbox.icon"
          >
        </v-icon>
        <img
          height="160px"
          v-if="dialogbox.image"
          :src="dialogbox.image"
        />
        <v-card-text
          >
          <h2
            class="headline"
            v-if="dialogbox.title"
            v-html="trans(dialogbox.title)"
            >
          </h2>
        </v-card-text>
        <v-card-text
            v-if="dialogbox.text"
            v-html="trans(dialogbox.text)"
            >
        </v-card-text>
      </v-card-text>

      <v-card-actions
        v-if="dialogbox.cancel || dialogbox.action"
        :class="dialogbox.discard ? `layout column wrap align-end` : `flex row wrap`"
        class="emphasis--medium"
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
