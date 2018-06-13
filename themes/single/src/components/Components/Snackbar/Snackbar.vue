<template>
  <v-snackbar
    :bottom="snackbar.y === 'bottom'"
    :color="snackbar.color"
    :dark="theme.dark"
    :left="snackbar.x === 'left'"
    :light="!theme.dark"
    :multi-line="snackbar.mode === 'multi-line'"
    :right="snackbar.x === 'right'"
    :timeout="snackbar.timeout"
    :top="snackbar.y === 'top'"
    :vertical="snackbar.mode === 'vertical'"
    v-model="snackbar.model"
    >
    <span v-html="snackbar.text"></span>
    <v-btn v-if="snackbar.close" icon @click="close({timeout: 100}, true)" small><v-icon small>close</v-icon></v-btn>
  </v-snackbar>
</template>

<script>
import store from '@/store'
import { mapGetters } from 'vuex'

export default {
  store,
  name: 'Snackbar',
  computed: {
    ...mapGetters({
      snackbar: 'snackbar/snackbar'
    })
  },
  methods: {
    close: function (snack, hide) {
      this.$store.dispatch('snackbar/TOGGLE_TOAST', Object.assign(this.snackbar, snack, { model: false }))
    }
  }
}
</script>
