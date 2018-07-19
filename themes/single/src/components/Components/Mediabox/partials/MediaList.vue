<template>
  <v-layout row wrap align-start justify-start>
    <folder v-for="i in 5" :key="i" @dblclick.native="open" :color="colors.primary"></folder>
  </v-layout>
</template>

<script>
import Folder from '@/components/Components/Folder/Folder'

export default {
  name: 'MediaList',

  components: {
    Folder
  },

  data () {
    return {
      colors: this.$vuetify.theme
    }
  },

  methods: {
    select ($event) {
      alert('single click')
      console.log($event.target.$el)
      $event.target.el.classList.add('blue')
    },

    open () {
      alert('doiuble clicj')
    }
  }
}
</script>
