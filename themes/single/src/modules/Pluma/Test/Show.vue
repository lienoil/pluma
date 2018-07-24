<template>
  <v-toolbar
    :class="dataset.toolbarClass"
    :flat="dataset.flat"
    :color="dataset.color"
    :dark="dataset.theme.dark"
  >
  <v-toolbar-title>Test</v-toolbar-title>
  <v-spacer v-if="dataset.spacer"></v-spacer>
  >>> icons
</template>

<script>
export default {
  data () {
    return {
      dataset: {
        color: 'primary',
        flat: true,
        theme: {
          dark: true
        },
        spacer: true
      }
    }
  },
}
</script>
