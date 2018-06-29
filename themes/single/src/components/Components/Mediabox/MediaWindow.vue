<template>
  <v-card v-show="visible" height="90vh" :dark="$root.theme.dark" :light="!$root.theme.dark">
    asd
  </v-card>
</template>

<script>
export default {
  name: 'MediaWindow',
  model: {
    prop: 'visible'
  },
  props: {
    visible: { type: Boolean, default: false }
  }
}
</script>
