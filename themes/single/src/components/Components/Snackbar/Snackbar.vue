<template>
  <v-snackbar
    :bottom="snackbar.y === 'bottom'"
    :color="snackbar.color"
    :left="snackbar.x === 'left'"
    :multi-line="snackbar.mode === 'multi-line'"
    :right="snackbar.x === 'right'"
    :timeout="snackbar.timeout"
    :top="snackbar.y === 'top'"
    :vertical="snackbar.mode === 'vertical'"
    dark
    v-model="snackbar.model"
    >
    <span v-html="snackbar.text"></span>
    <v-btn v-if="snackbar.close" icon @click="snackbar.model = false" small><v-icon small>close</v-icon></v-btn>
  </v-snackbar>
</template>

<script>
export default {
  data () {
    return {
      snackbar: {
        color: 'secondary',
        icon: 'info',
        close: true,
        type: 'success',
        timeout: 10000,
        model: false,
        title: '',
        text: '',
        x: 'right',
        y: 'bottom'
      }
    }
  }
}
</script>
